<?php
session_start();

require_once(__DIR__ . '/../config/connection.php');

// Define que todas as respostas serão em formato JSON
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// Extrai username e password do array $data
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Usuário e senha são obrigatórios.'
    ]);
    exit;
}

// Busca usuário na tabela 'usuarios' pelo campo 'usuario'
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$username]);

$user = $stmt->fetch();

if ($user && password_verify($password, $user['senha'])) {
    // Usado para verificar se está logado (api.php, admin.php)
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nome'];
    echo json_encode(['success' => true]);
    
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Credenciais inválidas.'
    ]);
}
