<?php
session_start();

header('Content-Type: application/json');

// Verifica se o usuário está autenticado
if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'authenticated' => true,
        'userName' => $_SESSION['user_name'] ?? 'Admin'
    ]);
} else {
    echo json_encode([
        'authenticated' => false,
        'userName' => null
    ]);
}
?>
