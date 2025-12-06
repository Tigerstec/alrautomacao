<?php
session_start();

// Verifica sessão
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Acesso não autorizado.']);
    exit;
}

// Carrega o Autoload
require_once __DIR__ . '/../../vendor/autoload.php';

// Importa os Controladores
use app\controllers\OrcamentoController;
use app\controllers\ServicoController;
use app\controllers\AgendamentoController;
use app\controllers\OverviewController;

header('Content-Type: application/json');

try {
    $entity = $_GET['entity'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $_GET['id'] ?? null;
    
    // Pega o JSON enviado no corpo da requisição (para POST/PUT)
    $input = json_decode(file_get_contents('php://input'), true);

    switch ($entity) {
        case 'overview':
            (new OverviewController())->handleRequest();
            break;

        case 'budgets':
            (new OrcamentoController())->handleRequest($method, $id, $input);
            break;

        case 'services':
            (new ServicoController())->handleRequest($method, $id, $input);
            break;

        case 'appointments':
            (new AgendamentoController())->handleRequest($method, $id, $input);
            break;
        
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Entidade não encontrada.']);
            break;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
}