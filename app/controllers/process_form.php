<?php
// Arquivo: process-form.php

// Define o cabeçalho para que o navegador saiba que a resposta é JSON
header('Content-Type: application/json');

// Inclui o arquivo de conexão PDO.
// Ajuste o caminho se necessário.
require_once 'app/config/connection.php'; 

// Array para armazenar a resposta JSON
$response = [];

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário (ótima prática, mantenha!)
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validação básica
    if (empty($name) || empty($company) || empty($email) || empty($phone) || empty($location) || empty($service) || empty($description)) {
        // Se a validação falhar, define a resposta de erro
        $response = [
            'status' => 'error',
            'message' => 'Por favor, preencha todos os campos obrigatórios.'
        ];
    } else {
        try {
            // 1. Prepara a query SQL para inserção com placeholders (?)
            $sql = "INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            // Prepara a declaração usando o objeto $pdo da sua conexão
            $stmt = $pdo->prepare($sql);

            // 2. Executa a query passando os valores em um array
            // O PDO associa cada '?' a um elemento do array, na ordem.
            // Isso previne SQL Injection de forma segura.
            $stmt->execute([$name, $company, $email, $phone, $location, $service, $description]);

            // 3. Se a linha acima executou sem erros, a inserção foi bem-sucedida
            $response = [
                'status' => 'success',
                'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
            ];

        } catch (PDOException $e) {
            // Se qualquer erro de banco de dados ocorrer, o PDO vai lançar uma exceção
            // e o código dentro do 'catch' será executado.
            
            // É uma boa prática registrar o erro real para análise interna
            error_log("Erro no banco de dados: " . $e->getMessage());

            // Envia uma mensagem genérica para o usuário
            $response = [
                'status' => 'error',
                'message' => 'Ocorreu um erro ao enviar sua solicitação. Por favor, tente novamente mais tarde.'
            ];
        }
    }
} else {
    // Se a requisição não for POST, define uma resposta de erro
    $response = [
        'status' => 'error',
        'message' => 'Método de requisição inválido.'
    ];
}

// Garante que o objeto PDO seja fechado (opcional, o PHP faz isso no final, mas é bom hábito)
$pdo = null;

// Retorna a resposta em formato JSON
echo json_encode($response);
exit; // Garante que nenhum outro conteúdo seja enviado após o JSON
?>