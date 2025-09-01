<?php
// app/config/connection.php

// Configurações do banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alrbd";

// Tenta estabelecer a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Opcional: Define o charset para UTF-8
$conn->set_charset("utf8");

// Não feche a tag PHP aqui.