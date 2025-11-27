
<?php
// ========================================
// API ADMINISTRATIVA (DUPLICADO - VER api.php)
// ========================================
// NOTA: Este arquivo parece ser duplicado de api.php
// Recomenda-se unificar ambos em um único arquivo
// ========================================

// ========================================
// INICIALIZAÇÃO DA SESSÃO
// ========================================
session_start();

// ========================================
// PROTEÇÃO DE ACESSO
// ========================================
// Verifica se usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // HTTP 401 Unauthorized
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

// ========================================
// IMPORTAÇÕES E CONFIGURAÇÕES
// ========================================
// Importa conexão com banco de dados ($pdo)
require_once 'app/config/connection.php';

// Define resposta como JSON
header('Content-Type: application/json');

// ========================================
// CAPTURA DE PARÂMETROS
// ========================================
// $entity: Recurso solicitado (overview, budgets, services, appointments)
$entity = $_GET['entity'] ?? '';

// $method: Método HTTP (GET, POST, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// $id: ID do registro (para DELETE)
$id = $_GET['id'] ?? null;

// $input: Dados JSON enviados no corpo da requisição
$input = json_decode(file_get_contents('php://input'), true);

// ========================================
// ROTEAMENTO POR ENTIDADE
// ========================================
// Switch simples baseado em $entity e $method
switch ($entity) {
    
    // ========================================
    // CASE: OVERVIEW
    // ========================================
    case 'overview':
        if ($method === 'GET') {
            // Conta total de orçamentos
            $totalBudgets = $pdo->query("SELECT COUNT(*) as total FROM orcamentos")->fetchColumn();
            
            // Conta total de serviços
            $totalServices = $pdo->query("SELECT COUNT(*) as total FROM servicos")->fetchColumn();
            
            // Conta total de agendamentos
            $totalAppointments = $pdo->query("SELECT COUNT(*) as total FROM agendamentos")->fetchColumn();
            
            // Soma valores de orçamentos aprovados
            $totalRevenueBudgets = $pdo->query("SELECT SUM(valor) as total FROM orcamentos WHERE status = 'Aprovado'")->fetchColumn();
            
            // Soma preços de agendamentos concluídos (com JOIN)
            $totalRevenueAppointments = $pdo->query("
                SELECT SUM(s.preco) 
                FROM agendamentos a 
                JOIN servicos s ON a.servico_id = s.id 
                WHERE a.status = 'Concluído'
            ")->fetchColumn();

            // Calcula receita total
            $totalRevenue = ($totalRevenueBudgets ?? 0) + ($totalRevenueAppointments ?? 0);

            // Retorna estatísticas em JSON
            echo json_encode([
                'totalBudgets' => $totalBudgets,
                'totalServices' => $totalServices,
                'totalAppointments' => $totalAppointments,
                'totalRevenue' => number_format($totalRevenue, 2, ',', '.')
            ]);
        }
        break;

    // ========================================
    // CASE: BUDGETS (ORÇAMENTOS)
    // ========================================
    case 'budgets':
        
        // GET: Listar todos os orçamentos
        if ($method === 'GET') {
            $stmt = $pdo->query("SELECT * FROM orcamentos ORDER BY id DESC");
            echo json_encode($stmt->fetchAll());
            
        // POST: Criar novo orçamento
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
            // Status fixo: 'Pendente'
            $stmt->execute([
                $input['client'], 
                $input['email'], 
                $input['phone'], 
                $input['value'], 
                $input['description'], 
                'Pendente'
            ]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            
        // DELETE: Remover orçamento
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM orcamentos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;

    // ========================================
    // CASE: SERVICES (SERVIÇOS)
    // ========================================
    case 'services':
        
        // GET: Listar todos os serviços
        if ($method === 'GET') {
            $stmt = $pdo->query("SELECT * FROM servicos ORDER BY nome ASC");
            echo json_encode($stmt->fetchAll());
            
        // POST: Criar novo serviço
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $input['name'], 
                $input['category'], 
                $input['price'], 
                $input['duration'], 
                $input['description']
            ]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            
        // DELETE: Remover serviço
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;

    // ========================================
    // CASE: APPOINTMENTS (AGENDAMENTOS)
    // ========================================
    case 'appointments':
        
        // GET: Listar agendamentos com nome do serviço
        if ($method === 'GET') {
            // JOIN para trazer nome do serviço
            $stmt = $pdo->query("
                SELECT a.*, s.nome as serviceName 
                FROM agendamentos a
                JOIN servicos s ON a.servico_id = s.id
                ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC
            ");
            echo json_encode($stmt->fetchAll());
            
        // POST: Criar novo agendamento
        } elseif ($method === 'POST') {
            $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente, telefone, servico_id, data_agendamento, hora_agendamento, status, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $input['client'], 
                $input['phone'], 
                $input['serviceId'], 
                $input['date'], 
                $input['time'], 
                $input['status'], 
                $input['notes']
            ]);
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
            
        // DELETE: Remover agendamento
        } elseif ($method === 'DELETE' && $id) {
            $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
        }
        break;
    
    // ========================================
    // DEFAULT: Entidade não encontrada
    // ========================================
    default:
        http_response_code(404); // HTTP 404 Not Found
        echo json_encode(['error' => 'Entidade não encontrada.']);
        break;
}
?>