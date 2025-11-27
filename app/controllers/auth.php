<?php
// ========================================
// AUTENTICAÇÃO DE USUÁRIOS
// ========================================
// Arquivo responsável por processar login do painel administrativo
// Recebe credenciais via JSON e valida no banco de dados
// Retorna: JSON com sucesso ou erro
// ========================================

// ========================================
// INICIALIZAÇÃO DA SESSÃO
// ========================================
// Inicia sessão PHP para armazenar dados do usuário autenticado
session_start();

// ========================================
// IMPORTAÇÃO DA CONEXÃO COM BANCO
// ========================================
// Importa arquivo de configuração que disponibiliza objeto $pdo
// __DIR__: Diretório atual (app/controllers)
// /../config/connection.php: Navega para app/config/connection.php
require_once(__DIR__ . '/../config/connection.php');

// ========================================
// CONFIGURAÇÃO DE RESPOSTA JSON
// ========================================
// Define que todas as respostas serão em formato JSON
header('Content-Type: application/json');

// ========================================
// CAPTURA DE DADOS DA REQUISIÇÃO
// ========================================
// Decodifica JSON recebido no corpo da requisição
// file_get_contents('php://input'): Lê corpo raw da requisição
// json_decode(..., true): Converte JSON para array associativo PHP
$data = json_decode(file_get_contents('php://input'), true);

// Extrai username e password do array $data
// Operador ?? retorna string vazia se chave não existir
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// ========================================
// VALIDAÇÃO DE CAMPOS OBRIGATÓRIOS
// ========================================
// Verifica se username ou password estão vazios
if (empty($username) || empty($password)) {
    // Retorna JSON de erro
    echo json_encode([
        'success' => false, 
        'message' => 'Usuário e senha são obrigatórios.'
    ]);
    exit; // Encerra execução
}

// ========================================
// CONSULTA NO BANCO DE DADOS
// ========================================
// Busca usuário na tabela 'usuarios' pelo campo 'usuario'
// Prepared statement para prevenir SQL Injection
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$username]);

// Busca primeiro registro encontrado (ou false se não houver)
$user = $stmt->fetch();

// ========================================
// VERIFICAÇÃO DE CREDENCIAIS
// ========================================
// Verifica se:
// 1. $user existe (usuário foi encontrado no banco)
// 2. password_verify: Compara senha digitada com hash armazenado
//    - $password: Senha em texto plano digitada pelo usuário
//    - $user['senha']: Hash bcrypt armazenado no banco
if ($user && password_verify($password, $user['senha'])) {
    
    // ========================================
    // LOGIN BEM-SUCEDIDO
    // ========================================
    // Cria variáveis de sessão para identificar usuário logado
    
    // $_SESSION['user_id']: ID do usuário no banco
    // Usado para verificar se está logado (api.php, admin.php)
    $_SESSION['user_id'] = $user['id'];
    
    // $_SESSION['user_name']: Nome do usuário
    // Exibido no header do painel administrativo
    $_SESSION['user_name'] = $user['nome'];
    
    // Retorna JSON de sucesso
    echo json_encode(['success' => true]);
    
} else {
    
    // ========================================
    // LOGIN FALHOU
    // ========================================
    // Usuário não encontrado OU senha incorreta
    // Por segurança, não especificamos qual dos dois falhou
    echo json_encode([
        'success' => false, 
        'message' => 'Credenciais inválidas.'
    ]);
}
