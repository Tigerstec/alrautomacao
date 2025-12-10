<?php
// Define que o navegador deve interpretar resposta como JSON
header('Content-Type: application/json; charset=utf-8');
mb_internal_encoding('UTF-8');

// Carrega o Autoload do Composer (Isso carrega o DBConnection e o PHPMailer automaticamente)
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use core\database\DBConnection;
use app\config\EnvLoader;

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = mb_convert_encoding($_POST['name'] ?? '', 'UTF-8', 'auto');
    $company = mb_convert_encoding($_POST['company'] ?? '', 'UTF-8', 'auto');
    $email = mb_convert_encoding($_POST['email'] ?? '', 'UTF-8', 'auto');
    $phone = mb_convert_encoding($_POST['phone'] ?? '', 'UTF-8', 'auto');
    $location = mb_convert_encoding($_POST['location'] ?? '', 'UTF-8', 'auto');
    $service = mb_convert_encoding($_POST['service'] ?? '', 'UTF-8', 'auto');
    $description = mb_convert_encoding($_POST['description'] ?? '', 'UTF-8', 'auto');

    // Verifica se TODOS os campos foram preenchidos
    if (empty($name) || empty($company) || empty($email) || empty($phone) || empty($location) || empty($service) || empty($description)) {
        $response = [
            'status' => 'error', 
            'message' => 'Por favor, preencha todos os campos obrigatórios.'
        ];
        echo json_encode($response);
        exit;
    } 
    
    try {
        // Carrega as variáveis do .env
        EnvLoader::load();
        
        // Instancia a classe de conexão
        $database = new DBConnection();
        // Recupera o objeto PDO nativo para usar nos prepares abaixo
        $pdo = $database->getConn();
        // ---------------------------------

        $sql = "INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $company, $email, $phone, $location, $service, $description]);

        // Só tenta enviar email se salvou no banco com sucesso
        try {
            $mail = new PHPMailer(true);
            
            // Carrega configurações de email do .env
            $mailHost = EnvLoader::get('MAIL_HOST');
            $mailUsername = EnvLoader::get('MAIL_USERNAME');
            $mailPassword = EnvLoader::get('MAIL_PASSWORD');
            $mailEncryption = EnvLoader::get('MAIL_ENCRYPTION');
            $mailPort = EnvLoader::get('MAIL_PORT');
            $mailFromEmail = EnvLoader::get('MAIL_FROM_EMAIL');
            $mailFromName = EnvLoader::get('MAIL_FROM_NAME');
            
            // Configurações do Servidor
            $mail->isSMTP();
            $mail->Host       = $mailHost;
            $mail->SMTPAuth   = true;
            $mail->Username   = $mailUsername;
            $mail->Password   = $mailPassword;
            $mail->SMTPSecure = ($mailEncryption === 'smtps') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int)$mailPort;
            $mail->CharSet    = 'UTF-8';
            $mail->Encoding   = 'base64';

            // Destinatários
            $mail->setFrom($mailFromEmail, mb_encode_mimeheader($mailFromName, 'UTF-8'));
            $mail->addAddress('guikovacs013@gmail.com', 'Administrador');
            $mail->addReplyTo($email, mb_encode_mimeheader($name, 'UTF-8')); // Se responder, vai para o cliente

            // Conteúdo
            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Novo Contato pelo Site: ' . $name, 'UTF-8');
            
            // Template HTML com meta charset
            $body = "<!DOCTYPE html>";
            $body .= "<html lang='pt-BR'>";
            $body .= "<head><meta charset='UTF-8'><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'></head>";
            $body .= "<body style='font-family: Arial, sans-serif; color: #333;'>";
            $body .= "<div style='background-color: #f4f4f4; padding: 20px;'>";
            $body .= "<div style='background-color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #E65100;'>";
            $body .= "<h2 style='color: #E65100; margin-top: 0;'>Nova Solicitação de Serviço</h2>";
            $body .= "<p><strong>Cliente:</strong> " . $name . "</p>";
            $body .= "<p><strong>Empresa:</strong> " . $company . "</p>";
            $body .= "<p><strong>Email:</strong> " . $email . "</p>";
            $body .= "<p><strong>Telefone:</strong> " . $phone . "</p>";
            $body .= "<p><strong>Local:</strong> " . $location . "</p>";
            $body .= "<p><strong>Serviço:</strong> " . $service . "</p>";
            $body .= "<hr style='border: 1px solid #eee;'>";
            $body .= "<h3>Descrição do Problema:</h3>";
            $body .= "<p style='background-color: #f9f9f9; padding: 15px; border-radius: 4px;'>" . nl2br($description) . "</p>";
            $body .= "</div><p style='font-size: 12px; color: #999; text-align: center;'>Mensagem enviada automaticamente pelo site.</p></div>";
            $body .= "</body></html>";
            
            $mail->Body = $body;
            $mail->AltBody = "Novo contato de $name ($company).\nTelefone: $phone\nServiço: $service\n\nDescrição:\n$description";

            $mail->send();

            $response = [
                'status' => 'success',
                'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
            ];

        } catch (Exception $e) {
            // Erro apenas no envio do email (mas salvou no banco)
            error_log("Erro PHPMailer: " . $mail->ErrorInfo);
            
            $response = [
                'status' => 'success',
                'message' => 'Sua solicitação foi recebida com sucesso! Em breve entraremos em contato.'
            ];
        }

    } catch (Exception $e) {
        // Erro na conexão ou ao salvar no banco
        error_log("Erro Geral/BD: " . $e->getMessage());
        
        $response = [
            'status' => 'error', 
            'message' => 'Ocorreu um erro ao processar sua solicitação. Detalhes técnicos foram registrados.'
        ];
    }
    
} else {
    $response = [
        'status' => 'error', 
        'message' => 'Método de requisição inválido.'
    ];
}

echo json_encode($response);
exit;
