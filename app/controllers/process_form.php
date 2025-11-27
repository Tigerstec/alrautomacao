<?php
// ========================================
// PROCESSAMENTO DE FORMULÁRIO DE CONTATO
// ========================================
// Arquivo: app/controllers/process_form.php
//
// Responsável por:
// 1. Receber dados do formulário de contato (index.php)
// 2. Validar e sanitizar dados
// 3. Salvar no banco de dados (tabela contact_submissions)
// 4. Enviar email de notificação via PHPMailer
// 5. Retornar JSON com status da operação
// ========================================

// ========================================
// CONFIGURAÇÃO DE RESPOSTA JSON
// ========================================
// Define que o navegador deve interpretar resposta como JSON
header('Content-Type: application/json');

// ========================================
// IMPORTAÇÃO DE CLASSES DO PHPMAILER
// ========================================
// PHPMailer: Biblioteca para envio de emails via SMTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// ========================================
// IMPORTAÇÃO DE ARQUIVOS (CAMINHOS RELATIVOS)
// ========================================
// __DIR__: Diretório atual (app/controllers)
// ../../: Sobe 2 níveis (até raiz do projeto)

// Classes do PHPMailer
require_once __DIR__ . '/../../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer/src/SMTP.php';

// Conexão com banco de dados (disponibiliza $pdo)
require_once __DIR__ . '/../config/connection.php';

// ========================================
// INICIALIZAÇÃO DE VARIÁVEL DE RESPOSTA
// ========================================
// Array que será convertido em JSON no final
// Array que será convertido em JSON no final
$response = [];

// ========================================
// VERIFICAÇÃO DO MÉTODO HTTP
// ========================================
// Aceita apenas requisições POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ========================================
    // ETAPA 1: SANITIZAÇÃO DOS DADOS
    // ========================================
    // filter_input(): Filtra e sanitiza dados do formulário
    // INPUT_POST: Origem dos dados ($_POST)
    // FILTER_SANITIZE_*: Remove caracteres indesejados
    
    // Nome do cliente
    // FILTER_SANITIZE_FULL_SPECIAL_CHARS: Converte caracteres especiais em HTML entities
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

    // ========================================
    // ETAPA 2: VALIDAÇÃO BÁSICA
    // ========================================
    // Verifica se TODOS os campos foram preenchidos
    if (empty($name) || empty($company) || empty($email) || empty($phone) || empty($location) || empty($service) || empty($description)) {
        // Retorna erro se algum campo estiver vazio
        $response = [
            'status' => 'error', 
            'message' => 'Por favor, preencha todos os campos obrigatórios.'
        ];
        
    } else {
        
        // ========================================
        // VERIFICAÇÃO DA CONEXÃO COM BANCO
        // ========================================
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
            
            // ========================================
            // ETAPA 3: INSERÇÃO NO BANCO DE DADOS
            // ========================================
            // Salva dados do formulário na tabela contact_submissions
            
            // SQL com prepared statement (previne SQL Injection)
            $sql = "INSERT INTO contact_submissions (name, company, email, phone, location, service, description) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            // Prepara statement
            $stmt = $pdo->prepare($sql);
            
            // Executa INSERT com array de valores
            // Ordem: name, company, email, phone, location, service, description
            $stmt->execute([$name, $company, $email, $phone, $location, $service, $description]);

            // ========================================
            // ETAPA 4: ENVIO DE EMAIL
            // ========================================
            // Só tenta enviar email se salvou no banco com sucesso
            try {
                
                // Cria nova instância do PHPMailer
                // true: Habilita exceções (throw exceptions em caso de erro)
                // Cria nova instância do PHPMailer
                // true: Habilita exceções (throw exceptions em caso de erro)
                $mail = new PHPMailer(true);

                // ========================================
                // CONFIGURAÇÕES DO SERVIDOR SMTP (CPANEL)
                // ========================================
                
                // isSMTP(): Define que usará servidor SMTP para envio
                $mail->isSMTP();
                
                // Host: Endereço do servidor SMTP (cPanel)
                $mail->Host       = 'alrautomacao.ifhost.gru.br';
                
                // SMTPAuth: Ativa autenticação SMTP
                $mail->SMTPAuth   = true;
                
                // Username: Email completo criado no cPanel
                // Usado para autenticar no servidor SMTP
                $mail->Username   = 'alruto@alrautomacao.ifhost.gru.br';
                
                // Password: Senha do email acima
                $mail->Password   = 'ifsp@alr2025';
                
                // SMTPSecure: Tipo de criptografia
                // ENCRYPTION_SMTPS = SSL (porta 465)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                
                // Port: Porta SMTP (465 para SSL)
                $mail->Port       = 465;
                
                // CharSet: Codificação de caracteres (UTF-8 para acentos)
                $mail->CharSet    = 'UTF-8';

                // ========================================
                // REMETENTE E DESTINATÁRIO
                // ========================================
                
                // setFrom(): Define remetente do email
                // Deve ser o mesmo email do Username (para autenticar)
                // Parâmetros: (email, nome_exibido)
                $mail->setFrom('alruto@alrautomacao.ifhost.gru.br', 'Site ALR Automação');
                
                // addAddress(): Define destinatário (quem receberá o email)
                // Email pessoal do administrador (Gmail)
                $mail->addAddress('leonardobernades.81@gmail.com', 'Administrador');
                
                // addReplyTo(): Define para onde vão respostas
                // Se clicar em "Responder", vai para o email do cliente
                // $email: Email do cliente (capturado do formulário)
                // $name: Nome do cliente
                // $email: Email do cliente (capturado do formulário)
                // $name: Nome do cliente
                $mail->addReplyTo($email, $name);

                // ========================================
                // CONTEÚDO DO EMAIL
                // ========================================
                
                // isHTML(): Define que o corpo do email é HTML (não texto puro)
                $mail->isHTML(true);
                
                // Subject: Assunto do email
                // Inclui nome do cliente para fácil identificação
                $mail->Subject = 'Novo Contato pelo Site: ' . $name;
                
                // ========================================
                // TEMPLATE HTML DO EMAIL
                // ========================================
                // Monta corpo do email com formatação HTML
                
                $body = "<html><body style='font-family: Arial, sans-serif; color: #333;'>";
                $body .= "<div style='background-color: #f4f4f4; padding: 20px;'>";
                $body .= "<div style='background-color: #fff; padding: 20px; border-radius: 8px; border-left: 5px solid #E65100;'>";
                
                // Título do email
                $body .= "<h2 style='color: #E65100; margin-top: 0;'>Nova Solicitação de Serviço</h2>";
                
                // Dados do cliente
                // htmlspecialchars(): Previne XSS (Cross-Site Scripting)
                $body .= "<p><strong>Cliente:</strong> " . htmlspecialchars($name) . "</p>";
                $body .= "<p><strong>Empresa:</strong> " . htmlspecialchars($company) . "</p>";
                $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
                $body .= "<p><strong>Telefone:</strong> " . htmlspecialchars($phone) . "</p>";
                $body .= "<p><strong>Local:</strong> " . htmlspecialchars($location) . "</p>";
                $body .= "<p><strong>Serviço:</strong> " . htmlspecialchars($service) . "</p>";
                
                // Linha divisória
                $body .= "<hr style='border: 1px solid #eee;'>";
                
                // Seção de descrição
                $body .= "<h3>Descrição do Problema:</h3>";
                // nl2br(): Converte quebras de linha (\n) em <br>
                $body .= "<p style='background-color: #f9f9f9; padding: 15px; border-radius: 4px;'>" . nl2br(htmlspecialchars($description)) . "</p>";
                
                // Rodapé
                $body .= "</div><p style='font-size: 12px; color: #999; text-align: center;'>Mensagem enviada automaticamente pelo site.</p></div>";
                $body .= "</body></html>";
                
                // Body: Corpo HTML do email
                $mail->Body = $body;
                
                // AltBody: Versão texto puro (para clientes que não suportam HTML)
                $mail->AltBody = "Novo contato de $name ($company).\nTelefone: $phone\nServiço: $service\n\nDescrição:\n$description";

                // ========================================
                // ENVIO DO EMAIL
                // ========================================
                // send(): Tenta enviar o email
                // Se falhar, lança Exception capturada pelo catch
                $mail->send();

                // ========================================
                // SUCESSO TOTAL
                // ========================================
                // Email enviado E salvou no banco
                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi enviada com sucesso! Em breve entraremos em contato. 🎉'
                ];

            } catch (Exception $e) {
                
                // ========================================
                // FALHA NO ENVIO DE EMAIL
                // ========================================
                // Email não foi enviado, MAS dados foram salvos no banco
                
                // error_log(): Registra erro no log do servidor
                // Permite verificar problema depois em error_log do PHP
                error_log("Erro PHPMailer: " . $mail->ErrorInfo);
                
                // Retorna sucesso mesmo assim (pois salvou no banco)
                // Administrador pode ver solicitação no painel admin
                $response = [
                    'status' => 'success',
                    'message' => 'Sua solicitação foi recebida com sucesso! Em breve entraremos em contato.'
                ];
            }

        } catch (PDOException $e) {
            
            // ========================================
            // FALHA NO BANCO DE DADOS
            // ========================================
            // Não conseguiu salvar no banco (erro crítico)
            
            // Registra erro no log do servidor
            error_log("Erro BD: " . $e->getMessage());
            
            // Retorna mensagem de erro ao usuário
            $response = [
                'status' => 'error', 
                'message' => 'Ocorreu um erro ao salvar sua solicitação. Tente novamente.'
            ];
        }
    }
    
} else {
    
    // ========================================
    // MÉTODO HTTP INVÁLIDO
    // ========================================
    // Requisição não é POST (GET, PUT, DELETE, etc.)
    $response = [
        'status' => 'error', 
        'message' => 'Método de requisição inválido.'
    ];
}

// ========================================
// FINALIZAÇÃO
// ========================================
// Fecha conexão com banco de dados
$pdo = null;

// Retorna resposta em JSON
echo json_encode($response);

// Encerra execução do script
exit;
?>
