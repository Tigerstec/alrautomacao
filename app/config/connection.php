<?php

// Configurações do banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alrbd";

try {
    // Tenta estabelecer a conexão usando PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Garante que os resultados venham como arrays associativos (opcional, mas bom)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de falha, exibe o erro e encerra a execução
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}
