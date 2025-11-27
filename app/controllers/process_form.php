<?php
// Arquivo: app/controllers/process_form.php

// Define o cabeçalho para que o navegador saiba que a resposta é JSON
header('Content-Type: application/json');

// Importa as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// --- CAMINHOS RELATIVOS (Baseados na sua estrutura de pastas) ---
// Usa __DIR__ para navegar a partir da pasta 'controllers'
require_once __DIR__ . 'PHPMailer/Exception';
require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../config/connection.php'; 

$response = [];

// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitização dos dados recebidos
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // 2. Validação básica
    if (empty($name) || empty($company) || empty($email) || empty($phone) || empty($location) || empty($service) || empty($description)) {
        $response = ['status' => 'error', 'message' => 'Por favor, preencha todos os campos obrigatórios.'];
    } else {
        // Verifica se a conexão com o banco ($pdo) existe
        if (!isset($pdo)) {
             $response = ['status' => 'error', 'message' => 'Erro interno: Falha na conexão com o banco de dados.'];
             echo json_encode($response);
             exit;
        }

        try {
            // 3. Inserção no Banco de Dados
            $sql = "INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $company, $email, $phone, $location, $service, $description]);

            // 4. Envio de E-mail (Só tenta se o banco salvou com sucesso)
            try {
                $mail = new PHPMailer(true); 

                // --- CONFIGURAÇÕES DO SERVIDOR SMTP (CPANEL) ---
                $mail->isSMTP();
                $mail->Host       = 'alrautomacao.ifhost.gru.br';   // <<< MUDE AQUI: Seu servidor SMTP (veja no cPanel)
                $mail->SMTPAuth   = true;   
                $mail->Username   = 'alruto@alrautomacao.ifhost.gru.br';// <<< MUDE AQUI: O e-mail que você criou no cPanel
                $mail->Password   = 'ifsp@alr2025';        // <<< MUDE AQUI: A senha desse e-mail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;// Porta 465 (SSL Padrão cPanel)
                $mail->Port       = 465; 
                $mail->CharSet    = 'UTF-8';

                // --- REMETENTE E DESTINATÁRIO ---
                // De: Deve ser o mesmo e-mail do Username acima (para autenticar)
                $mail->setFrom('alruto@alrautomacao.ifhost.gru.br', 'Site ALR Automação'); 
                
                // Para: Seu e-mail pessoal que vai receber o aviso (GMAIL)
                $mail->addAddress('guikovacs013@gmail.com', 'Administrador'); 
                
                // Responder Para: Se você clicar em responder, vai para o cliente
                $mail->addReplyTo($email, $name); 

                // --- CONTEÚDO DO E-MAIL ---
                $mail->isHTML(true);
                $mail->Subject = 'Novo Contato pelo Site: ' . $name;
                
                // Template HTML do e-mail
                $body = "<html><body style='font-family: Arial, sans-serif; color: #333;'>";
                $body .= "<div style='background-color: #f4f4f4; padding: 20px;'>";
                $body .= "<div style='background-color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #E65100;'>";
                $body .= "<h2 style='color: #E65100; margin-top: 0;'>Nova Solicitação de Serviço</h2>";
                $body .= "<p><strong>Cliente:</strong> " . htmlspecialchars($name) . "</p>";
                $body .= "<p><strong>Empresa:</strong> " . htmlspecialchars($company) . "</p>";
                $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
                $body .= "<p><strong>Telefone:</strong> " . htmlspecialchars($phone) . "</p>";
                $body .= "<p><strong>Local:</strong> " . htmlspecialchars($location) . "</p>";
                $body .= "<p><strong>Serviço:</strong> " . htmlspecialchars($service) . "</p>";
                $body .= "<hr style='border: 1px solid #eee;'>";
                $body .= "<h3>Descrição do Problema:</h3>";
                $body .= "<p style='background-color: #f9f9f9; padding: 15px; border-radius: 4px;'>" . nl2br(htmlspecialchars($description)) . "</p>";
                $body .= "</div><p style='font-size: 12px; color: #999; text-align: center;'>Mensagem enviada automaticamente pelo site.</p></div>";
                $body .= "</body></html>";
                
                $mail->Body = $body;
                $mail->AltBody = "Novo contato de $name ($company).\nTelefone: $phone\nServiço: $service\n\nDescrição:\n$description";

                $mail->send();

                // Sucesso Total
                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
                ];

            } catch (Exception $e) {
                // Falha no E-mail (mas salvou no banco)
                // Loga o erro no servidor para você ver depois
                error_log("Erro PHPMailer: " . $mail->ErrorInfo);
                
                // Avisa o usuário que deu tudo certo (já que o pedido foi salvo no banco)
                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi recebida com sucesso! Em breve entraremos em contato.'
                ];
            }

        } catch (PDOException $e) {
            // Falha no Banco de Dados
            error_log("Erro BD: " . $e->getMessage());
            $response = ['status' => 'error', 'message' => 'Ocorreu um erro ao salvar sua solicitação. Tente novamente.'];
        }
    }
} else {
    $response = ['status' => 'error', 'message' => 'Método de requisição inválido.'];
}

// Fecha conexão e retorna JSON
$pdo = null;
echo json_encode($response);
exit;
?>
