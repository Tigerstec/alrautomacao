<?php

$servername = "40.160.64.65";
$username = "ifhostgru_alrautomacao";
$password = "ifsp@alr2025";
$dbname = "ifhostgru_alrautomacao";

try {
    // Tenta estabelecer a conexão usando PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Garante que os resultados venham como arrays associativos
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}



