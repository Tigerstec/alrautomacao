<?php
// Define que o navegador deve interpretar resposta como JSON
header('Content-Type: application/json');

// PHPMailer: Biblioteca para envio de emails via SMTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/../../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';

require_once __DIR__ . '/../config/connection.php';

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Nome da empresa
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Email do cliente
    // FILTER_SANITIZE_EMAIL: Remove caracteres inválidos de email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    // Telefone
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Localização
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Serviço solicitado
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Descrição do problema/solicitação
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Verifica se TODOS os campos foram preenchidos
    if (empty($name) || empty($company) || empty($email) || empty($phone) || empty($location) || empty($service) || empty($description)) {
        $response = [
            'status' => 'error', 
            'message' => 'Por favor, preencha todos os campos obrigatórios.'
        ];
        
    } else {
    
        // Verifica se objeto $pdo foi criado em connection.php
        if (!isset($pdo)) {
            $response = [
                'status' => 'error', 
                'message' => 'Erro interno: Falha na conexão com o banco de dados.'
            ];
            echo json_encode($response);
            exit;
        }

        try {
            $sql = "INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $pdo->prepare($sql);
            
            // Executa INSERT com array de valores
            $stmt->execute([$name, $company, $email, $phone, $location, $service, $description]);

            // Só tenta enviar email se salvou no banco com sucesso
            try {

                $mail = new PHPMailer(true);
                
                $mail->isSMTP();
                
                $mail->Host       = 'alrautomacao.ifhost.gru.br';
                
                $mail->SMTPAuth   = true;
                
                $mail->Username   = 'alruto@alrautomacao.ifhost.gru.br';
                
                $mail->Password   = 'ifsp@alr2025';
                
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                
                $mail->Port       = 465;
                
                $mail->CharSet    = 'UTF-8';

                $mail->setFrom('alruto@alrautomacao.ifhost.gru.br', 'Site ALR Automação');
                
                $mail->addAddress('guikovacs013@gmail.com', 'Administrador');
                
                // Se clicar em "Responder", vai para o email do cliente
                // $email: Email do cliente (capturado do formulário)
                // $name: Nome do cliente
                // $email: Email do cliente (capturado do formulário)
                // $name: Nome do cliente
                $mail->addReplyTo($email, $name);

                $mail->isHTML(true);
                
                $mail->Subject = 'Novo Contato pelo Site: ' . $name;
                
                // ========================================
                // TEMPLATE HTML DO EMAIL
                // ========================================    
                $body = "<html><body style='font-family: Arial, sans-serif; color: #333;'>";
                $body .= "<div style='background-color: #f4f4f4; padding: 20px;'>";
                $body .= "<div style='background-color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #E65100;'>";
                
                // Título do email
                $body .= "<h2 style='color: #E65100; margin-top: 0;'>Nova Solicitação de Serviço</h2>";
                
                // Dados do cliente
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

                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
                ];

            } catch (Exception $e) {
                
                error_log("Erro PHPMailer: " . $mail->ErrorInfo);
                
                // Retorna sucesso mesmo assim (pois salvou no banco)
                // Administrador pode ver solicitação no painel admin
                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi recebida com sucesso! Em breve entraremos em contato.'
                ];
            }

        } catch (PDOException $e) {
            
            error_log("Erro BD: " . $e->getMessage());
            
            $response = [
                'status' => 'error', 
                'message' => 'Ocorreu um erro ao salvar sua solicitação. Tente novamente.'
            ];
        }
    }
    
} else {
    
    $response = [
        'status' => 'error', 
        'message' => 'Método de requisição inválido.'
    ];
}

$pdo = null;

echo json_encode($response);

exit;
?>
