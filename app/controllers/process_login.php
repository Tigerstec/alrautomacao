
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

require_once 'app/config/connection.php';
header('Content-Type: application/json');

$entity = $_GET['entity'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

// Roteamento simples baseado na entidade e no método HTTP
switch ($entity) {
    case 'overview':
        if ($method === 'GET') {
            $totalBudgets = $pdo->query("SELECT COUNT(*) as total FROM orcamentos")->fetchColumn();
            $totalServices = $pdo->query("SELECT COUNT(*) as total FROM servicos")->fetchColumn();
            $totalAppointments = $pdo->query("SELECT COUNT(*) as total FROM agendamentos")->fetchColumn();
            
            $totalRevenueBudgets = $pdo->query("SELECT SUM(valor) as total FROM orcamentos WHERE status = 'Aprovado'")->fetchColumn();
            $totalRevenueAppointments = $pdo->query("
                SELECT SUM(s.preco) 
                FROM agendamentos a 
                JOIN servicos s ON a.servico_id = s.id 
                WHERE a.status = 'Concluído'
            ")->fetchColumn();

            $totalRevenue = ($totalRevenueBudgets ?? 0) + ($totalRevenueAppointments ?? 0);

            echo json_encode([
                'totalBudgets' => $totalBudgets,
                'totalServices' => $totalServices,
                'totalAppointments' => $totalAppointments,
                'totalRevenue' => number_format($totalRevenue, 2, ',', '.')
            ]);
        }
        break;

    case 'budgets':
        if ($method === 'GET') {
            $stmt = $pdo->query("SELECT * FROM orcamentos ORDER BY id DESC");
            echo json_encode($stmt->fetchAll());
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$input['client'], $input['email'], $input['phone'], $input['value'], $input['description'], 'Pendente']);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM orcamentos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;

    case 'services':
        if ($method === 'GET') {
            $stmt = $pdo->query("SELECT * FROM servicos ORDER BY nome ASC");
            echo json_encode($stmt->fetchAll());
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$input['name'], $input['category'], $input['price'], $input['duration'], $input['description']]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;

    case 'appointments':
        if ($method === 'GET') {
             $stmt = $pdo->query("
                SELECT a.*, s.nome as serviceName 
                FROM agendamentos a
                JOIN servicos s ON a.servico_id = s.id
                ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC
            ");
            echo json_encode($stmt->fetchAll());
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente, telefone, servico_id, data_agendamento, hora_agendamento, status, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$input['client'], $input['phone'], $input['serviceId'], $input['date'], $input['time'], $input['status'], $input['notes']]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;
    
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Entidade não encontrada.']);
        break;
}
?>