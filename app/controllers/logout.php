<?php
session_start();

header('Content-Type: application/json');

// Destrói a sessão
session_destroy();

echo json_encode(['success' => true]);
?>