<?php
// Arquivo: process_form.php

// Define o cabeçalho para que o navegador saiba que a resposta é JSON
header('Content-Type: application/json');

// Inclui o arquivo de conexão.
// Assumindo que 'process_form.php' está no mesmo nível que 'app/' ou um nível acima.
// Ajuste o caminho se necessário, com base na localização real do 'connection.php'
require_once 'app/config/connection.php'; 

// Array para armazenar a resposta JSON
$response = [];

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
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
            // Prepara a query SQL para inserção usando mysqli
            // O 's' no 'sssssss' representa o tipo de dado para cada parâmetro (string)
            $stmt = $conn->prepare("INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Verifica se a preparação da query foi bem-sucedida
            if ($stmt === false) {
                // Erro na preparação da query
                error_log("Erro na preparação da query: " . $conn->error);
                $response = [
                    'status' => 'error',
                    'message' => 'Ocorreu um erro interno. Por favor, tente novamente mais tarde. (Erro P01)' // Código de erro para debug interno
                ];
            } else {
                // Faz o bind dos parâmetros. Os tipos devem corresponder aos placeholders na query.
                $stmt->bind_param('sssssss', $name, $company, $email, $phone, $location, $service, $description);

                // Executa a query
                if ($stmt->execute()) {
                    // Sucesso no registro
                    $response = [
                        'status' => 'success',
                        'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
                    ];
                } else {
                    // Erro ao executar a query
                    error_log("Erro ao executar a query: " . $stmt->error);
                    $response = [
                        'status' => 'error',
                        'message' => 'Ocorreu um erro ao enviar sua solicitação. Tente novamente. (Erro D01)' // Código de erro para debug interno
                    ];
                }

                // Fecha o statement
                $stmt->close();
            }

        } catch (Exception $e) {
            // Log do erro (não exiba detalhes do erro para o usuário final em produção)
            error_log("Erro geral: " . $e->getMessage());
            $response = [
                'status' => 'error',
                'message' => 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde. (Erro G01)' // Código de erro para debug interno
            ];
        } finally {
            // Garante que a conexão seja fechada, se estiver aberta
            if (isset($conn) && $conn->ping()) {
                $conn->close();
            }
        }
    }
} else {
    // Se a requisição não for POST, define uma resposta de erro
    $response = [
        'status' => 'error',
        'message' => 'Método de requisição inválido.'
    ];
}

// Retorna a resposta em formato JSON
echo json_encode($response);
exit; // Garante que nenhum outro conteúdo seja enviado após o JSON
?>
