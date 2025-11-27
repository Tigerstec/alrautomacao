<?php
// ========================================
// API REST - PAINEL ADMINISTRATIVO
// ========================================
// Arquivo responsável por processar todas as requisições AJAX do painel admin
// Métodos suportados: GET, POST, PUT, DELETE
// Formato de resposta: JSON
// ========================================

// ========================================
// INICIALIZAÇÃO DA SESSÃO
// ========================================
// Inicia ou retoma sessão PHP para verificar autenticação
session_start();

// ========================================
// PROTEÇÃO DE ACESSO
// ========================================
// Verifica se usuário está autenticado
// Se $_SESSION['user_id'] não existir, bloqueia acesso à API
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // HTTP 401 Unauthorized
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit; // Encerra execução do script
}

// ========================================
// CONFIGURAÇÕES E IMPORTAÇÕES
// ========================================
// Importa configurações de conexão com banco de dados (PDO)
// $pdo: Objeto PDO para comunicação com MySQL
require_once __DIR__ . '/../config/connection.php';

// Define cabeçalho HTTP para retornar JSON
header('Content-Type: application/json');

// ========================================
// CAPTURA DE PARÂMETROS DA REQUISIÇÃO
// ========================================
// $entity: Define qual recurso está sendo acessado (overview, budgets, services, appointments)
// Origem: Query string da URL (?entity=budgets)
$entity = $_GET['entity'] ?? '';

// $method: Método HTTP da requisição (GET, POST, PUT, DELETE)
// Origem: Variável global $_SERVER
$method = $_SERVER['REQUEST_METHOD'];

// $id: ID do registro para operações específicas (editar, deletar)
// Origem: Query string da URL (?id=5)
$id = $_GET['id'] ?? null;

// $input: Dados enviados no corpo da requisição (formato JSON)
// Decodifica JSON recebido e converte para array associativo PHP
$input = json_decode(file_get_contents('php://input'), true);

// ========================================
// BLOCO TRY-CATCH PARA TRATAMENTO DE ERROS
// ========================================
// Captura exceções PDO (erros de banco de dados)
try {
    
    // ========================================
    // ROTEAMENTO POR ENTIDADE (SWITCH-CASE)
    // ========================================
    // Direciona requisição para o recurso correto baseado em $entity
    switch ($entity) {
        
        // ========================================
        // CASE: OVERVIEW (VISÃO GERAL)
        // ========================================
        // Endpoint: ?entity=overview
        // Método: GET
        // Retorna estatísticas gerais do sistema
        case 'overview':
            if ($method === 'GET') {
                
                // Conta total de orçamentos cadastrados
                // Tabela: orcamentos | Retorna: número inteiro
                $totalBudgets = $pdo->query("SELECT COUNT(*) FROM orcamentos")->fetchColumn();
                
                // Conta total de serviços cadastrados
                // Tabela: servicos | Retorna: número inteiro
                $totalServices = $pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();
                
                // Conta total de agendamentos cadastrados
                // Tabela: agendamentos | Retorna: número inteiro
                $totalAppointments = $pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn();
                
                // Soma valores dos orçamentos aprovados
                // Filtra apenas orçamentos com status 'Aprovado'
                $totalRevenueBudgets = $pdo->query("SELECT SUM(valor) FROM orcamentos WHERE status = 'Aprovado'")->fetchColumn();
                
                // Soma preços dos serviços concluídos
                // JOIN entre agendamentos e serviços para pegar o preço
                // Filtra apenas agendamentos com status 'Concluído'
                $totalRevenueAppointments = $pdo->query("SELECT SUM(s.preco) FROM agendamentos a JOIN servicos s ON a.servico_id = s.id WHERE a.status = 'Concluído'")->fetchColumn();

                // Calcula receita total (orçamentos + agendamentos)
                // Operador ?? retorna 0 se valor for NULL
                $totalRevenue = ($totalRevenueBudgets ?? 0) + ($totalRevenueAppointments ?? 0);

                // Retorna JSON com estatísticas
                // number_format: Formata valor para padrão brasileiro (1.234,56)
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
        // Endpoint: ?entity=budgets
        // Métodos: GET, POST, PUT, DELETE
        // CRUD completo para orçamentos
        case 'budgets':
            
            // GET: Listar todos os orçamentos
            // Retorna array de orçamentos ordenados por ID decrescente
            if ($method === 'GET') {
                // SELECT com formatação de data (dd/mm/yyyy)
                // Ordenação: Mais recentes primeiro
                $stmt = $pdo->query("SELECT *, DATE_FORMAT(data_criacao, '%d/%m/%Y') as data_formatada FROM orcamentos ORDER BY id DESC");
                echo json_encode($stmt->fetchAll());
                
            // POST: Criar novo orçamento
            // Dados recebidos em $input (array associativo)
            } elseif ($method === 'POST') {
                // Prepared statement para prevenir SQL Injection
                $stmt = $pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
                
                // Executa INSERT com dados do $input
                // $input['client'] → cliente
                // $input['email'] → email
                // $input['phone'] → telefone
                // $input['value'] → valor
                // $input['description'] → descricao
                // $input['status'] ?? 'Pendente' → status (padrão: Pendente)
                $stmt->execute([
                    $input['client'], 
                    $input['email'], 
                    $input['phone'], 
                    $input['value'], 
                    $input['description'], 
                    $input['status'] ?? 'Pendente'
                ]);
                
                // Retorna sucesso e ID do registro inserido
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                
            // PUT: Atualizar orçamento existente
            // Requer $id na URL (?id=5)
            } elseif ($method === 'PUT' && $id) {
                // UPDATE com prepared statement
                $stmt = $pdo->prepare("UPDATE orcamentos SET cliente = ?, email = ?, telefone = ?, valor = ?, descricao = ?, status = ? WHERE id = ?");
                
                // Executa UPDATE com dados do $input + $id
                $stmt->execute([
                    $input['client'], 
                    $input['email'], 
                    $input['phone'], 
                    $input['value'], 
                    $input['description'], 
                    $input['status'], 
                    $id
                ]);
                
                echo json_encode(['success' => true]);
                
            // DELETE: Remover orçamento
            // Requer $id na URL (?id=5)
            } elseif ($method === 'DELETE' && $id) {
                // DELETE com prepared statement
                $stmt = $pdo->prepare("DELETE FROM orcamentos WHERE id = ?");
                $stmt->execute([$id]);
                
                echo json_encode(['success' => true]);
            }
            break;

        // ========================================
        // CASE: SERVICES (SERVIÇOS)
        // ========================================
        // Endpoint: ?entity=services
        // Métodos: GET, POST, PUT, DELETE
        // CRUD completo para serviços
        case 'services':
            
            // GET: Listar todos os serviços
            // Retorna array de serviços ordenados por nome
            if ($method === 'GET') {
                // SELECT ordenado alfabeticamente por nome
                $stmt = $pdo->query("SELECT * FROM servicos ORDER BY nome ASC");
                echo json_encode($stmt->fetchAll());
                
            // POST: Criar novo serviço
            // Dados recebidos em $input (array associativo)
            } elseif ($method === 'POST') {
                // Prepared statement para INSERT
                $stmt = $pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
                
                // Executa INSERT com dados do $input
                // $input['name'] → nome
                // $input['category'] → categoria
                // $input['price'] → preco
                // $input['duration'] → duracao
                // $input['description'] → descricao
                $stmt->execute([
                    $input['name'], 
                    $input['category'], 
                    $input['price'], 
                    $input['duration'], 
                    $input['description']
                ]);
                
                // Retorna sucesso e ID do registro inserido
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                
            // PUT: Atualizar serviço existente
            // Requer $id na URL (?id=5)
            } elseif ($method === 'PUT' && $id) {
                // UPDATE com prepared statement
                $stmt = $pdo->prepare("UPDATE servicos SET nome = ?, categoria = ?, preco = ?, duracao = ?, descricao = ? WHERE id = ?");
                
                // Executa UPDATE com dados do $input + $id
                $stmt->execute([
                    $input['name'], 
                    $input['category'], 
                    $input['price'], 
                    $input['duration'], 
                    $input['description'], 
                    $id
                ]);
                
                echo json_encode(['success' => true]);
                
            // DELETE: Remover serviço
            // Requer $id na URL (?id=5)
            } elseif ($method === 'DELETE' && $id) {
                // DELETE com prepared statement
                $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
                $stmt->execute([$id]);
                
                echo json_encode(['success' => true]);
            }
            break;

        // ========================================
        // CASE: APPOINTMENTS (AGENDAMENTOS)
        // ========================================
        // Endpoint: ?entity=appointments
        // Métodos: GET, POST, PUT, DELETE
        // CRUD completo para agendamentos
        case 'appointments':
            
            // GET: Listar todos os agendamentos com dados do serviço
            // Retorna array de agendamentos com JOIN na tabela servicos
            if ($method === 'GET') {
                // SELECT com JOIN para trazer nome e preço do serviço
                // a.* → todos os campos de agendamentos
                // s.nome as serviceName → nome do serviço
                // s.preco as servicePrice → preço do serviço
                // Ordenação: Data e hora decrescente (mais recentes primeiro)
                $stmt = $pdo->query("
                    SELECT a.*, s.nome as serviceName, s.preco as servicePrice
                    FROM agendamentos a
                    JOIN servicos s ON a.servico_id = s.id
                    ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC
                ");
                echo json_encode($stmt->fetchAll());
                
            // POST: Criar novo agendamento
            // Dados recebidos em $input (array associativo)
            } elseif ($method === 'POST') {
                // Prepared statement para INSERT
                $stmt = $pdo->prepare("INSERT INTO agendamentos (cliente, telefone, servico_id, data_agendamento, hora_agendamento, status, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
                
                // Executa INSERT com dados do $input
                // $input['client'] → cliente
                // $input['phone'] → telefone
                // $input['serviceId'] → servico_id (FK para tabela servicos)
                // $input['date'] → data_agendamento
                // $input['time'] → hora_agendamento
                // $input['status'] → status
                // $input['notes'] → observacoes
                $stmt->execute([
                    $input['client'], 
                    $input['phone'], 
                    $input['serviceId'], 
                    $input['date'], 
                    $input['time'], 
                    $input['status'], 
                    $input['notes']
                ]);
                
                // Retorna sucesso e ID do registro inserido
                echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
                
            // PUT: Atualizar agendamento existente
            // Requer $id na URL (?id=5)
            } elseif ($method === 'PUT' && $id) {
                // UPDATE com prepared statement
                $stmt = $pdo->prepare("UPDATE agendamentos SET cliente = ?, telefone = ?, servico_id = ?, data_agendamento = ?, hora_agendamento = ?, status = ?, observacoes = ? WHERE id = ?");
                
                // Executa UPDATE com dados do $input + $id
                $stmt->execute([
                    $input['client'], 
                    $input['phone'], 
                    $input['serviceId'], 
                    $input['date'], 
                    $input['time'], 
                    $input['status'], 
                    $input['notes'], 
                    $id
                ]);
                
                echo json_encode(['success' => true]);
                
            // DELETE: Remover agendamento
            // Requer $id na URL (?id=5)
            } elseif ($method === 'DELETE' && $id) {
                // DELETE com prepared statement
                $stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
                $stmt->execute([$id]);
                
                echo json_encode(['success' => true]);
            }
            break;
        
        // ========================================
        // DEFAULT: Entidade não encontrada
        // ========================================
        // Retorna erro 404 se $entity não corresponder a nenhum case
        default:
            http_response_code(404); // HTTP 404 Not Found
            echo json_encode(['error' => 'Entidade não encontrada.']);
            break;
    }
    
// ========================================
// TRATAMENTO DE EXCEÇÕES PDO
// ========================================
// Captura erros de banco de dados (conexão, sintaxe SQL, etc.)
} catch (PDOException $e) {
    http_response_code(500); // HTTP 500 Internal Server Error
    
    // Retorna JSON com mensagem de erro
    // IMPORTANTE: Em produção, não expor mensagem detalhada ($e->getMessage())
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>