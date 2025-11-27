<?php
/**
 * ========================================
 * PAINEL ADMINISTRATIVO - ALR AUTOMAÇÕES
 * ========================================
 * 
 * Arquivo principal do painel administrativo.
 * Gerencia sessão de usuário e exibe interface de administração.
 * 
 * FLUXO DE AUTENTICAÇÃO:
 * 1. session_start() - Inicia sessão PHP
 * 2. Verifica $_SESSION['user_id'] para determinar se usuário está logado
 * 3. Se logado: exibe dashboard (#dashboard)
 * 4. Se não logado: exibe tela de login (#loginScreen)
 * 
 * VARIÁVEIS PHP CRÍTICAS:
 * - $_SESSION['user_id'] - ID do usuário logado (verificado em app/controllers/auth.php)
 * - $_SESSION['user_name'] - Nome do usuário para exibição
 * - $is_logged_in - Booleano que controla visibilidade de seções
 */

// Inicia sessão PHP para gerenciar autenticação
session_start();

// Verifica se existe user_id na sessão (usuário autenticado)
// Esta variável controla toda a lógica de exibição do painel
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Meta tags básicas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Painel Administrativo - Sistema de Gestão</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="../public/assets/images/logoweb.ico">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- ========================================
        ESTILOS CUSTOMIZADOS E ANIMAÇÕES
        ========================================
        Define animações CSS e comportamento do menu mobile
    -->
    <style>
        /* ========================================
        ANIMAÇÕES CSS
        ========================================
        Animações de entrada para elementos do painel
        */
        
        /* Animação fade-in: elemento aparece gradualmente */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(10px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        /* Animação slide-in: elemento desliza da esquerda */
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        /* ========================================
        MENU MOBILE - CONTROLE DE VISIBILIDADE
        ========================================
        Em telas menores que 768px (mobile):
        - Botão hambúrguer é exibido
        - Sidebar fica oculta por padrão (left: -100%)
        - Sidebar.active desliza para dentro (left: 0)
        - Overlay escurece fundo quando menu aberto
        */
        
        /* Esconde botão hambúrguer em desktop */
        #mobileMenuBtn {
            display: none;
        }
        
        /* Media query para dispositivos mobile */
        @media (max-width: 768px) {
            /* Exibe botão hambúrguer em mobile */
            #mobileMenuBtn {
                display: block;
            }
            
            /* Sidebar inicialmente fora da tela */
            #sidebar {
                position: fixed;
                left: -100%;              /* Posiciona fora da tela à esquerda */
                top: 0;
                height: 100vh;           /* Altura total da viewport */
                z-index: 50;             /* Acima do conteúdo */
                transition: left 0.3s ease; /* Transição suave */
            }
            
            /* Sidebar visível quando classe 'active' é adicionada */
            #sidebar.active {
                left: 0;                 /* Move para posição visível */
            }
            
            /* Overlay de fundo (escurece tela) */
            #mobileOverlay {
                display: none;           /* Oculto por padrão */
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente */
                z-index: 40;             /* Abaixo da sidebar, acima do conteúdo */
            }
            
            /* Overlay visível quando menu aberto */
            #mobileOverlay.active {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    
    <!-- ========================================
        TELA DE LOGIN
        ========================================
        Exibida quando $is_logged_in = false
        
        FLUXO DE LOGIN:
        1. Usuário preenche campos #username e #password
        2. Submit do formulário #loginForm é interceptado por admin.js
        3. JavaScript envia dados via AJAX para app/controllers/process_login.php
        4. Backend valida credenciais e retorna JSON: {success: true/false}
        5. Se sucesso: recarrega página (agora com sessão ativa)
        6. Se erro: exibe mensagem em #loginError
            
        CONTROLE DE VISIBILIDADE:
        - Classe 'hidden' adicionada via PHP se $is_logged_in = true
        - JavaScript em admin.js também pode manipular visibilidade
    -->
    <div id="loginScreen" class="min-h-screen flex items-center justify-center p-4 <?php echo $is_logged_in ? 'hidden' : ''; ?>">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
            
            <!-- Cabeçalho do login com ícone de cadeado -->
            <div class="text-center mb-8">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Acesso Administrativo</h1>
                <p class="text-gray-600 mt-2">Entre com suas credenciais</p>
            </div>
            
            <!-- Formulário de login - ID 'loginForm' manipulado por admin.js -->
            <form id="loginForm" class="space-y-6">
                
                <!-- Campo de usuário -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuário</label>
                    <!-- ID 'username' - valor capturado pelo JavaScript -->
                    <input type="text" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Digite seu usuário" required>
                </div>
                
                <!-- Campo de senha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <!-- ID 'password' - valor capturado pelo JavaScript -->
                    <input type="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Digite sua senha" required>
                </div>
                
                <!-- Container de erro - inicialmente oculto -->
                <!-- ID 'loginError' - preenchido dinamicamente pelo JavaScript quando login falha -->
                <div id="loginError" class="hidden p-3 bg-red-100 text-red-700 rounded-lg text-sm"></div>

                <!-- Botão de submit -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">
                    Entrar no Sistema
                </button>
                
                <!-- Botão voltar para página principal -->
                <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-200 font-medium">
                    <a href="home">Voltar para página principal</a>
                </button>
            </form>
        </div>
    </div>

        <!-- ========================================
            DASHBOARD PRINCIPAL
            ========================================
            Exibido quando $is_logged_in = true
            
            ESTRUTURA:
            - Header com logo, nome do usuário e botão sair
            - Sidebar de navegação (menu lateral)
            - Main content area (área principal com seções)
            
            CONTROLE DE VISIBILIDADE:
            - Classe 'hidden' adicionada via PHP se $is_logged_in = false
        -->
    <div id="dashboard" class="<?php echo !$is_logged_in ? 'hidden' : ''; ?>">
        
            <!-- ========================================
                HEADER DO DASHBOARD
                ========================================
                Barra superior fixa com:
                - Botão menu mobile (#mobileMenuBtn)
                - Logo e título
                - Nome do usuário ($_SESSION['user_name'])
                - Botão de logout
            -->
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-4 md:px-6 py-4">
                
                <!-- Lado esquerdo: Menu mobile + Logo -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    
                    <!-- Botão hambúrguer (visível apenas em mobile) -->
                    <!-- ID 'mobileMenuBtn' - evento click abre sidebar mobile -->
                    <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <!-- Logo -->
                    <div class="bg-indigo-600 w-8 h-8 md:w-10 md:h-10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    
                    <!-- Título responsivo -->
                    <h1 class="text-base md:text-xl font-bold text-gray-800 hidden sm:block">Painel Administrativo</h1>
                    <h1 class="text-base font-bold text-gray-800 sm:hidden">Painel</h1>
                </div>
                
                <!-- Lado direito: Nome do usuário + Botão sair -->
                <div class="flex items-center space-x-2 md:space-x-4">
                    <!-- Nome do usuário da sessão PHP -->
                    <!-- $_SESSION['user_name'] - definido em process_login.php após login bem-sucedido -->
                    <span class="text-xs md:text-sm text-gray-600 hidden sm:inline">
                        Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?>
                    </span>
                    
                    <!-- Botão de logout - link para logoutAction (rota em ctrlRotas.php) -->
                    <a href="logoutAction" class="bg-red-500 text-white px-2 py-1 md:px-4 md:py-2 text-xs md:text-sm rounded-lg hover:bg-red-600 transition duration-200">
                        Sair
                    </a>
                </div>
            </div>
        </header>
        
        <!-- Overlay para escurecer fundo quando menu mobile aberto -->
        <!-- ID 'mobileOverlay' - click fecha o menu -->
        <div id="mobileOverlay"></div>

            <!-- ========================================
                LAYOUT PRINCIPAL: FLEX CONTAINER
                ========================================
                Estrutura flex: Sidebar (esquerda) + Main content (direita)
            -->
        <div class="flex">
            
                <!-- ========================================
                    SIDEBAR - MENU LATERAL DE NAVEGAÇÃO
                    ========================================
                    ID 'sidebar' - manipulado por admin.js para mobile
                    
                    BOTÕES DE NAVEGAÇÃO:
                    - onclick="showSection('overview')" - mostra visão geral
                    - onclick="showSection('budgets')" - mostra orçamentos
                    - onclick="showSection('services')" - mostra serviços
                    - onclick="showSection('appointments')" - mostra agendamentos
                    
                    CLASSE 'nav-btn':
                    - Usada pelo JavaScript para identificar botões de navegação
                    - Permite adicionar/remover estado ativo
                -->
            <nav id="sidebar" class="bg-white w-64 min-h-screen shadow-lg slide-in">
                <div class="p-4 md:p-6">
                    
                    <!-- Botão fechar sidebar (visível apenas em mobile) -->
                    <!-- ID 'closeSidebarBtn' - evento click fecha sidebar em mobile -->
                    <button id="closeSidebarBtn" class="md:hidden mb-4 p-2 rounded-lg hover:bg-gray-100 w-full text-left flex items-center">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="ml-2 text-sm text-gray-600">Fechar Menu</span>
                    </button>
                    
                    <!-- Lista de navegação -->
                    <ul class="space-y-2">
                        
                        <!-- Item: Visão Geral -->
                        <!-- onclick chama showSection('overview') - função definida em admin.js -->
                        <li>
                            <button onclick="showSection('overview')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10"></path>
                                </svg>
                                <span>Visão Geral</span>
                            </button>
                        </li>
                        
                        <!-- Item: Orçamentos -->
                        <!-- onclick chama showSection('budgets') - exibe seção de orçamentos -->
                        <li>
                            <button onclick="showSection('budgets')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span>Orçamentos</span>
                            </button>
                        </li>
                        
                        <!-- Item: Serviços -->
                        <!-- onclick chama showSection('services') - exibe seção de serviços -->
                        <li>
                            <button onclick="showSection('services')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                <span>Serviços</span>
                            </button>
                        </li>
                        
                        <!-- Item: Agendamentos -->
                        <!-- onclick chama showSection('appointments') - exibe seção de agendamentos -->
                        <li>
                            <button onclick="showSection('appointments')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Agendamentos</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>

                <!-- ========================================
                    MAIN CONTENT - ÁREA PRINCIPAL DE CONTEÚDO
                    ========================================
                    Contém todas as seções do dashboard:
                    - overviewSection: Visão geral com estatísticas
                    - budgetsSection: Lista de orçamentos recebidos
                    - servicesSection: Gerenciamento de serviços
                    - appointmentsSection: Gerenciamento de agendamentos
                    
                    CONTROLE DE EXIBIÇÃO:
                    - JavaScript showSection() oculta todas e exibe uma por vez
                -->
            <main class="flex-1 p-4 md:p-6">
                
                    <!-- ========================================
                        SEÇÃO: VISÃO GERAL (OVERVIEW)
                        ========================================
                        ID 'overviewSection' - exibida por padrão
                        Classe 'section' - usada pelo JavaScript para controle
                        
                        ESTRUTURA:
                        - Cards de estatísticas (Total Orçamentos, Serviços Ativos, etc.)
                        - Gráfico de atividades recentes
                        - Lista de últimas atividades
                        
                        IDs DE CONTADORES (preenchidos via JavaScript/AJAX):
                        - #totalBudgets: Total de orçamentos
                        - #totalServices: Serviços ativos
                        - #totalAppointments: Agendamentos
                        - #totalRevenue: Receita total
                    -->
                <div id="overviewSection" class="section fade-in">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 md:mb-6">Visão Geral do Sistema</h2>
                    
                    <!-- Grid responsivo de cards de estatísticas -->
                    <!-- 1 coluna em mobile, 2 em tablet, 4 em desktop -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
                        
                        <!-- Card: Total de Orçamentos -->
                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Total Orçamentos</p>
                                    <!-- ID 'totalBudgets' - atualizado dinamicamente -->
                                    <p class="text-xl md:text-2xl font-bold text-gray-800" id="totalBudgets">0</p>
                                </div>
                                <div class="bg-blue-100 p-2 md:p-3 rounded-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card: Serviços Ativos -->
                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Serviços Ativos</p>
                                    <!-- ID 'totalServices' - atualizado dinamicamente -->
                                    <p class="text-xl md:text-2xl font-bold text-gray-800" id="totalServices">0</p>
                                </div>
                                <div class="bg-green-100 p-2 md:p-3 rounded-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card: Total de Agendamentos -->
                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Agendamentos</p>
                                    <!-- ID 'totalAppointments' - atualizado dinamicamente -->
                                    <p class="text-xl md:text-2xl font-bold text-gray-800" id="totalAppointments">0</p>
                                </div>
                                <div class="bg-purple-100 p-2 md:p-3 rounded-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card: Receita Total -->
                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Receita Total</p>
                                    <!-- ID 'totalRevenue' - atualizado dinamicamente -->
                                    <p class="text-xl md:text-2xl font-bold text-gray-800">R$ <span id="totalRevenue">0,00</span></p>
                                </div>
                                <div class="bg-yellow-100 p-2 md:p-3 rounded-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- ========================================
                        SEÇÃO: ORÇAMENTOS (BUDGETS)
                        ========================================
                        ID 'budgetsSection' - controlada via showSection('budgets')
                        Classe 'section hidden' - oculta por padrão
                        
                        ESTRUTURA:
                        - Botão "+ Novo Orçamento" (onclick="showBudgetForm()")
                        - Formulário de criação (#budgetForm - oculto inicialmente)
                        - Lista de orçamentos (#budgetsList - preenchida via JS)
                        
                        IDs DE CAMPOS DO FORMULÁRIO:
                        - #budgetClient: Nome do cliente
                        - #budgetEmail: Email do cliente
                        - #budgetPhone: Telefone do cliente
                        - #budgetValue: Valor do orçamento (formatado por formatarMoeda())
                        - #budgetDescription: Descrição do orçamento
                        
                        FUNÇÕES JAVASCRIPT:
                        - showBudgetForm(): Exibe formulário de novo orçamento
                        - hideBudgetForm(): Oculta formulário
                        - formatarMoeda(this): Formata valor em Real (R$)
                        - Submit do #budgetFormData envia via AJAX
                    -->
                <div id="budgetsSection" class="section hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Gestão de Orçamentos</h2>
                        <!-- Botão para exibir formulário de novo orçamento -->
                        <button onclick="showBudgetForm()" class="bg-indigo-600 text-white px-3 py-2 md:px-4 md:py-2 text-sm rounded-lg hover:bg-indigo-700 transition duration-200 w-full sm:w-auto">+ Novo Orçamento</button>
                    </div>
                    
                    <!-- Formulário de novo orçamento - ID 'budgetForm' -->
                    <!-- Inicialmente hidden, exibido por showBudgetForm() -->
                    <div id="budgetForm" class="hidden bg-white p-4 md:p-6 rounded-xl shadow-sm border mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold mb-4">Criar Novo Orçamento</h3>
                        <!-- ID 'budgetFormData' - submit tratado em admin.js -->
                        <form id="budgetFormData" class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            
                            <!-- Campo: Nome do Cliente -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Cliente</label>
                                <input type="text" id="budgetClient" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Email -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="budgetEmail" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Telefone -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Telefone</label>
                                <input type="tel" id="budgetPhone" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Valor em Reais -->
                            <!-- onkeyup="formatarMoeda(this)" - formata entrada como moeda -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Valor (R$)</label>
                                <input type="text" id="budgetValue" onkeyup="formatarMoeda(this)" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="0,00" required>
                            </div>
                            
                            <!-- Campo: Descrição (span de 2 colunas) -->
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                <textarea id="budgetDescription" rows="3" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></textarea>
                            </div>
                            
                            <!-- Botões de ação -->
                            <div class="md:col-span-2 flex flex-col sm:flex-row gap-2 sm:gap-4">
                                <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-green-700 transition duration-200">Salvar Orçamento</button>
                                <!-- onclick="hideBudgetForm()" - esconde formulário -->
                                <button type="button" onclick="hideBudgetForm()" class="w-full sm:w-auto bg-gray-500 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-gray-600 transition duration-200">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Container da lista de orçamentos -->
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 md:p-6">
                            <h3 class="text-base md:text-lg font-semibold mb-4">Orçamentos Cadastrados</h3>
                            <!-- ID 'budgetsList' - preenchido dinamicamente pelo JavaScript -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4" id="budgetsList"></div>
                        </div>
                    </div>
                </div>

                    <!-- ========================================
                        SEÇÃO: SERVIÇOS (SERVICES)
                        ========================================
                        ID 'servicesSection' - controlada via showSection('services')
                        Classe 'section hidden' - oculta por padrão
                        
                        ESTRUTURA:
                        - Botão "+ Novo Serviço" (onclick="showServiceForm()")
                        - Formulário de criação (#serviceForm - oculto inicialmente)
                        - Lista de serviços (#servicesList - preenchida via JS)
                        
                        IDs DE CAMPOS DO FORMULÁRIO:
                        - #serviceName: Nome do serviço
                        - #serviceCategory: Categoria (consultoria, desenvolvimento, etc.)
                        - #servicePrice: Preço (formatado por formatarMoeda())
                        - #serviceDuration: Duração em minutos
                        - #serviceDescription: Descrição do serviço
                        
                        FUNÇÕES JAVASCRIPT:
                        - showServiceForm(): Exibe formulário de novo serviço
                        - hideServiceForm(): Oculta formulário
                        - Submit do #serviceFormData envia via AJAX
                    -->
                <div id="servicesSection" class="section hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Gestão de Serviços</h2>
                        <!-- Botão para exibir formulário de novo serviço -->
                        <button onclick="showServiceForm()" class="bg-indigo-600 text-white px-3 py-2 md:px-4 md:py-2 text-sm rounded-lg hover:bg-indigo-700 transition duration-200 w-full sm:w-auto">+ Novo Serviço</button>
                    </div>
                    
                    <!-- Formulário de novo serviço - ID 'serviceForm' -->
                    <!-- Inicialmente hidden, exibido por showServiceForm() -->
                    <div id="serviceForm" class="hidden bg-white p-4 md:p-6 rounded-xl shadow-sm border mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold mb-4">Criar Novo Serviço</h3>
                        <!-- ID 'serviceFormData' - submit tratado em admin.js -->
                        <form id="serviceFormData" class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            
                            <!-- Campo: Nome do Serviço -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Nome do Serviço</label>
                                <input type="text" id="serviceName" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Categoria (select com opções predefinidas) -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Categoria</label>
                                <select id="serviceCategory" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="">Selecione</option>
                                    <option value="consultoria">Consultoria</option>
                                    <option value="desenvolvimento">Desenvolvimento</option>
                                    <option value="assistenciatecnica">Assistência Técnica</option>
                                    <option value="outros">Outros</option>
                                </select>
                            </div>
                            
                            <!-- Campo: Preço com formatação de moeda -->
                            <!-- onkeyup="formatarMoeda(this)" - formata entrada como moeda -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>
                                <input type="text" id="servicePrice" onkeyup="formatarMoeda(this)" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="0,00" required>
                            </div>
                            
                            <!-- Campo: Duração em minutos -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Duração (minutos)</label>
                                <input type="number" id="serviceDuration" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Descrição (span de 2 colunas) -->
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                <textarea id="serviceDescription" rows="3" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                            </div>
                            
                            <!-- Botões de ação -->
                            <div class="md:col-span-2 flex flex-col sm:flex-row gap-2 sm:gap-4">
                                <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-green-700 transition duration-200">Salvar Serviço</button>
                                <!-- onclick="hideServiceForm()" - esconde formulário -->
                                <button type="button" onclick="hideServiceForm()" class="w-full sm:w-auto bg-gray-500 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-gray-600 transition duration-200">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Container da lista de serviços -->
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 md:p-6">
                            <h3 class="text-base md:text-lg font-semibold mb-4">Serviços Cadastrados</h3>
                            <!-- ID 'servicesList' - preenchido dinamicamente pelo JavaScript -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4" id="servicesList"></div>
                        </div>
                    </div>
                </div>

                    <!-- ========================================
                        SEÇÃO: AGENDAMENTOS (APPOINTMENTS)
                        ========================================
                        ID 'appointmentsSection' - controlada via showSection('appointments')
                        Classe 'section hidden' - oculta por padrão
                        
                        ESTRUTURA:
                        - Botão "+ Novo Agendamento" (onclick="showAppointmentForm()")
                        - Formulário de criação (#appointmentForm - oculto inicialmente)
                        - Lista de agendamentos (#appointmentsList - preenchida via JS)
                        
                        IDs DE CAMPOS DO FORMULÁRIO:
                        - #appointmentClient: Nome do cliente
                        - #appointmentPhone: Telefone do cliente
                        - #appointmentService: Serviço (select preenchido dinamicamente)
                        - #appointmentDate: Data do agendamento
                        - #appointmentTime: Horário do agendamento
                        - #appointmentStatus: Status (Agendado, Confirmado, etc.)
                        - #appointmentNotes: Observações adicionais
                        
                        FUNÇÕES JAVASCRIPT:
                        - showAppointmentForm(): Exibe formulário de novo agendamento
                        - hideAppointmentForm(): Oculta formulário
                        - Submit do #appointmentFormData envia via AJAX
                    -->
                <div id="appointmentsSection" class="section hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Agendamentos de Serviços</h2>
                        <!-- Botão para exibir formulário de novo agendamento -->
                        <button onclick="showAppointmentForm()" class="bg-indigo-600 text-white px-3 py-2 md:px-4 md:py-2 text-sm rounded-lg hover:bg-indigo-700 transition duration-200 w-full sm:w-auto">+ Novo Agendamento</button>
                    </div>
                    
                    <!-- Formulário de novo agendamento - ID 'appointmentForm' -->
                    <!-- Inicialmente hidden, exibido por showAppointmentForm() -->
                    <div id="appointmentForm" class="hidden bg-white p-4 md:p-6 rounded-xl shadow-sm border mb-4 md:mb-6">
                        <h3 class="text-base md:text-lg font-semibold mb-4">Agendar Serviço</h3>
                        <!-- ID 'appointmentFormData' - submit tratado em admin.js -->
                        <form id="appointmentFormData" class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                            
                            <!-- Campo: Nome do Cliente -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Cliente</label>
                                <input type="text" id="appointmentClient" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Telefone -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Telefone</label>
                                <input type="tel" id="appointmentPhone" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Serviço (select preenchido dinamicamente pelo JS) -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Serviço</label>
                                <select id="appointmentService" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></select>
                            </div>
                            
                            <!-- Campo: Data -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Data</label>
                                <input type="date" id="appointmentDate" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Horário -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Horário</label>
                                <input type="time" id="appointmentTime" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                            
                            <!-- Campo: Status (select com opções predefinidas) -->
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select id="appointmentStatus" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="Agendado">Agendado</option>
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Em Andamento">Em Andamento</option>
                                    <option value="Concluído">Concluído</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>
                            
                            <!-- Campo: Observações (span de 2 colunas) -->
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Observações</label>
                                <textarea id="appointmentNotes" rows="3" class="w-full px-3 py-2 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"></textarea>
                            </div>
                            
                            <!-- Botões de ação -->
                            <div class="md:col-span-2 flex flex-col sm:flex-row gap-2 sm:gap-4">
                                <button type="submit" class="w-full sm:w-auto bg-green-600 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-green-700 transition duration-200">Salvar Agendamento</button>
                                <!-- onclick="hideAppointmentForm()" - esconde formulário -->
                                <button type="button" onclick="hideAppointmentForm()" class="w-full sm:w-auto bg-gray-500 text-white px-4 md:px-6 py-2 md:py-3 text-sm md:text-base rounded-lg hover:bg-gray-600 transition duration-200">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Container da lista de agendamentos -->
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 md:p-6">
                            <h3 class="text-base md:text-lg font-semibold mb-4">Agendamentos</h3>
                            <!-- ID 'appointmentsList' - preenchido dinamicamente pelo JavaScript -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4" id="appointmentsList"></div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Campo oculto para armazenar ID durante edição -->
    <!-- ID 'editingId' - usado para saber qual registro está sendo editado -->
    <input type="hidden" id="editingId">

        <!-- ========================================
            JAVASCRIPT EXTERNO
            ========================================
            admin.js contém a lógica principal:
            - Funções showSection(), showBudgetForm(), etc.
            - Requisições AJAX para API
            - Manipulação de formulários
            - Renderização de listas dinâmicas
        -->
    <script src="../public/assets/js/admin.js"></script>
    
        <!-- ========================================
            JAVASCRIPT INLINE - MENU MOBILE
            ========================================
            Controla abertura/fechamento do menu lateral em dispositivos móveis
            
            ELEMENTOS:
            - mobileMenuBtn: Botão hambúrguer no header
            - closeSidebarBtn: Botão fechar dentro da sidebar
            - sidebar: Menu lateral de navegação
            - mobileOverlay: Overlay escuro de fundo
            
            FUNÇÕES:
            - openMobileMenu(): Adiciona classe 'active' para exibir menu e overlay
            - closeMobileMenu(): Remove classe 'active' para esconder menu e overlay
            
            EVENTOS:
            - Click em mobileMenuBtn → abre menu
            - Click em closeSidebarBtn → fecha menu
            - Click em mobileOverlay → fecha menu
            - Click em .nav-btn (em mobile) → fecha menu após navegação
        -->
    <script>
        // ========================================
        // CAPTURA DE ELEMENTOS DO DOM
        // ========================================
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        
        // ========================================
        // FUNÇÃO: Abrir Menu Mobile
        // ========================================
        // Adiciona classe 'active' aos elementos para exibir menu
        // Bloqueia scroll do body enquanto menu está aberto
        function openMobileMenu() {
            sidebar.classList.add('active');
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Impede scroll da página
        }
        
        // ========================================
        // FUNÇÃO: Fechar Menu Mobile
        // ========================================
        // Remove classe 'active' para esconder menu e overlay
        // Restaura scroll do body
        function closeMobileMenu() {
            sidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Restaura scroll da página
        }
        
        // ========================================
        // EVENT LISTENERS
        // ========================================
        
        // Botão hambúrguer - abre menu
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }
        
        // Botão fechar - fecha menu
        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeMobileMenu);
        }
        
        // Overlay - fecha menu ao clicar fora
        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', closeMobileMenu);
        }
        
        // Fecha menu ao clicar em item de navegação (somente em mobile)
        // Percorre todos os botões com classe 'nav-btn'
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Verifica se é mobile (largura < 768px)
                if (window.innerWidth < 768) {
                    closeMobileMenu();
                }
            });
        });
    </script>
</body>
</html>
