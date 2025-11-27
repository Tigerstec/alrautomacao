<?php
session_start();
// Protege a API, garantindo que apenas usuários logados possam acessá-la
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

require_once __DIR__ . '/../config/connection.php';
header('Content-Type: application/json');

// Pega os parâmetros da requisição
$entity = $_GET['entity'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

/** newnew
 * Converte um valor monetário no formato brasileiro (R$ 1.234,56) para o formato SQL (1234.56).
 * @param string $valor O valor string a ser limpo.
 * @return float O valor numérico pronto para o banco de dados.
 */
function clean_money_value($valor) {
    // Remove o separador de milhar (ponto)
    $valor_limpo = str_replace('.', '', $valor); 
    // Troca a vírgula decimal por ponto decimal
    $valor_mysql = str_replace(',', '.', $valor_limpo); 
    return (float) $valor_mysql;
}

try {
    // Roteamento baseado na "entidade" (orçamentos, serviços, etc.)
    switch ($entity) {
        // ... case 'overview' não muda ...

        case 'budgets':
            if ($method === 'GET') {
                $stmt = $pdo->query("SELECT *, DATE_FORMAT(data_criacao, '%d/%m/%Y') as data_formatada FROM orcamentos ORDER BY id DESC");
                echo json_encode($stmt->fetchAll());
            } elseif ($method === 'POST') {
                // Limpeza do valor antes de passar para o banco
                $clean_value = clean_money_value($input['value']);
                
                $stmt = $pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$input['client'], $input['email'], $input['phone'], $clean_value, $input['description'], $input['status'] ?? 'Pendente']);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            } elseif ($method === 'PUT' && $id) {
                // Limpeza do valor antes de passar para o banco
                $clean_value = clean_money_value($input['value']);
                
                $stmt = $pdo->prepare("UPDATE orcamentos SET cliente = ?, email = ?, telefone = ?, valor = ?, descricao = ?, status = ? WHERE id = ?");
                $stmt->execute([$input['client'], $input['email'], $input['phone'], $clean_value, $input['description'], $input['status'], $id]);
                echo json_encode(['success' => true]);
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
                // Limpeza do preço antes de passar para o banco
                $clean_price = clean_money_value($input['price']);
                
                $stmt = $pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$input['name'], $input['category'], $clean_price, $input['duration'], $input['description']]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            } elseif ($method === 'PUT' && $id) {
                // Limpeza do preço antes de passar para o banco
                $clean_price = clean_money_value($input['price']);
                
                $stmt = $pdo->prepare("UPDATE servicos SET nome = ?, categoria = ?, preco = ?, duracao = ?, descricao = ? WHERE id = ?");
                $stmt->execute([$input['name'], $input['category'], $clean_price, $input['duration'], $input['description'], $id]);
                echo json_encode(['success' => true]);
            } elseif ($method === 'DELETE' && $id) {
                $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
                $stmt->execute([$id]);
                echo json_encode(['success' => true]);
            }
            break;

        case 'appointments':
            if ($method === 'GET') {
                 $stmt = $pdo->query("
                    SELECT a.*, s.nome as serviceName, s.preco as servicePrice
                    FROM agendamentos a
                    JOIN servicos s ON a.servico_id = s.id
                    ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC
                ");
                echo json_encode($stmt->fetchAll());
            } elseif ($method === 'POST') {
                $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente, telefone, servico_id, data_agendamento, hora_agendamento, status, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$input['client'], $input['phone'], $input['serviceId'], $input['date'], $input['time'], $input['status'], $input['notes']]);
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            } elseif ($method === 'PUT' && $id) {
                $stmt = $pdo->prepare("UPDATE agendamentos SET cliente = ?, telefone = ?, servico_id = ?, data_agendamento = ?, hora_agendamento = ?, status = ?, observacoes = ? WHERE id = ?");
                $stmt->execute([$input['client'], $input['phone'], $input['serviceId'], $input['date'], $input['time'], $input['status'], $input['notes'], $id]);
                echo json_encode(['success' => true]);
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
    
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>
