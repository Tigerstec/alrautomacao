<?php
session_start();

// Carrega o Autoload (assume que o arquivo está em app/actions/)
require_once __DIR__ . '/../../vendor/autoload.php';

use core\database\DBConnection;

// Define que todas as respostas serão em formato JSON
header('Content-Type: application/json');

try {
    // --- CONEXÃO POO ---
    $database = new DBConnection();
    $pdo = $database->getConn();
    // -------------------

    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Usuário e senha são obrigatórios.'
        ]);
        exit;
    }

    // Busca usuário na tabela 'usuarios'
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        echo json_encode([
            'success' => true,
            'userName' => $user['nome']
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Credenciais inválidas.'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()]);
}
?>