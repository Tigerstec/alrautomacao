<?php
// ========================================
// LOGOUT - ENCERRAMENTO DE SESSÃO
// ========================================
// Arquivo: app/controllers/logout.php
// 
// Responsável por fazer logout do usuário
// Destrói sessão PHP e redireciona para página de login
// ========================================

// ========================================
// INICIALIZAÇÃO DA SESSÃO
// ========================================
// Inicia sessão para poder acessar e manipular $_SESSION
// Necessário chamar session_start() antes de session_destroy()
session_start();

// ========================================
// DESTRUIÇÃO DA SESSÃO
// ========================================
// session_destroy(): Remove TODOS os dados da sessão
// 
// Efeito: Limpa $_SESSION['user_id'] e $_SESSION['user_name']
// Resultado: Usuário será considerado "não autenticado"
session_destroy();

// ========================================
// REDIRECIONAMENTO
// ========================================
// Redireciona para a página de administração
// Como a sessão foi destruída, admin.php exibirá tela de login
// 
// Location: /admin → Rota tratada por ctrlRotas.php
header('Location: /admin');

// Encerra execução do script
exit();
