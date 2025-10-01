<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .slide-in { animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { transform: translateX(-100%); } to { transform: translateX(0); } }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">

    <?php if (!isset($_SESSION['user_id'])): ?>
    
    <div id="loginScreen" class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 lg:p-10 w-full max-w-sm sm:max-w-md lg:max-w-lg mx-auto">
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">Acesso Administrativo</h1>
                <p class="text-gray-600 mt-2 text-sm sm:text-base">Entre com suas credenciais</p>
                <p id="loginError" class="text-red-500 text-xs sm:text-sm mt-2 hidden"></p>
            </div>
            
            <form id="loginForm" class="space-y-4 sm:space-y-6">
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Usuário</label>
                    <input type="text" id="username" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm sm:text-base" placeholder="Digite seu usuário" required>
                </div>
                
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Senha</label>
                    <input type="password" id="password" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-sm sm:text-base" placeholder="Digite sua senha" required>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 sm:py-3 rounded-lg hover:bg-indigo-700 active:bg-indigo-800 transition-all duration-200 font-medium text-sm sm:text-base focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Entrar no Sistema
                </button>
            </form>
        </div>
    </div>

    <?php else: ?>

    <div id="dashboard">
        <header class="bg-white shadow-sm border-b">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-4 sm:px-6 py-3 sm:py-4 space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <h1 class="text-lg sm:text-xl font-bold text-gray-800">Painel Administrativo</h1>
                </div>
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                    <span class="text-xs sm:text-sm text-gray-600 truncate max-w-full sm:max-w-none">
                        Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                    <a href="logoutAction" class="bg-red-500 text-white px-3 sm:px-4 py-1 sm:py-2 rounded-lg hover:bg-red-600 transition duration-200 text-sm w-full sm:w-auto text-center">
                        Sair
                    </a>
                </div>
            </div>
        </header>

        <div class="flex flex-col lg:flex-row">
            <!-- Menu Mobile Toggle -->
            <button id="menuToggle" class="lg:hidden bg-white p-4 shadow-sm border-b flex items-center justify-between">
                <span class="font-medium text-gray-700">Menu</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <nav id="sidebar" class="bg-white w-full lg:w-64 min-h-screen shadow-lg slide-in hidden lg:block">
                <div class="p-4 lg:p-6">
                    <ul class="space-y-2">
                        <li>
                            <button onclick="showSection('overview', this)" class="nav-btn w-full text-left px-3 lg:px-4 py-2 lg:py-3 rounded-lg flex items-center space-x-2 lg:space-x-3 text-sm lg:text-base">
                                <span>Visão Geral</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('budgets', this)" class="nav-btn w-full text-left px-3 lg:px-4 py-2 lg:py-3 rounded-lg flex items-center space-x-2 lg:space-x-3 text-sm lg:text-base">
                                <span>Orçamentos</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('services', this)" class="nav-btn w-full text-left px-3 lg:px-4 py-2 lg:py-3 rounded-lg flex items-center space-x-2 lg:space-x-3 text-sm lg:text-base">
                                <span>Serviços</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('appointments', this)" class="nav-btn w-full text-left px-3 lg:px-4 py-2 lg:py-3 rounded-lg flex items-center space-x-2 lg:space-x-3 text-sm lg:text-base">
                                <span>Agendamentos</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="flex-1 p-4 lg:p-6">
                <div id="overviewSection" class="section fade-in">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Visão Geral do Sistema</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border">
                            <p class="text-xs sm:text-sm text-gray-600">Total Orçamentos</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800" id="totalBudgets">0</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border">
                            <p class="text-xs sm:text-sm text-gray-600">Serviços Ativos</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800" id="totalServices">0</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border">
                            <p class="text-xs sm:text-sm text-gray-600">Agendamentos</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800" id="totalAppointments">0</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm border">
                            <p class="text-xs sm:text-sm text-gray-600 truncate">Receita Total</p>
                            <p class="text-xl sm:text-2xl font-bold text-gray-800">R$ <span id="totalRevenue">0,00</span></p>
                        </div>
                    </div>
                </div>

                <div id="budgetsSection" class="section hidden">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Gestão de Orçamentos</h2>
                    
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 sm:p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[600px]">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Cliente</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Contato</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Valor</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Status</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="budgetsList"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="servicesSection" class="section hidden">
                     <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 space-y-2 sm:space-y-0">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Gestão de Serviços</h2>
                        <button onclick="showServiceForm()" class="bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm sm:text-base w-full sm:w-auto">
                            + Novo Serviço
                        </button>
                    </div>

                    <div id="serviceForm" class="hidden bg-white p-4 sm:p-6 rounded-xl shadow-sm border mb-4 sm:mb-6">
                        </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="servicesList"></div>
                        </div>
                    </div>
                </div>

                <div id="appointmentsSection" class="section hidden">
                     <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 space-y-2 sm:space-y-0">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Agendamentos</h2>
                        <button onclick="showAppointmentForm()" class="bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm sm:text-base w-full sm:w-auto">
                            + Novo Agendamento
                        </button>
                    </div>

                     <div id="appointmentForm" class="hidden bg-white p-4 sm:p-6 rounded-xl shadow-sm border mb-4 sm:mb-6">
                        </div>

                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-4 sm:p-6">
                             <div class="overflow-x-auto">
                                <table class="w-full min-w-[700px]">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Cliente</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Serviço</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Data/Hora</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Status</th>
                                            <th class="text-left py-2 sm:py-3 px-2 sm:px-4 text-xs sm:text-sm">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="appointmentsList"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <?php endif; ?>

    <script>
        // Toggle menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (menuToggle && sidebar) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('hidden');
                });
                
                // Fechar menu ao clicar em um item (mobile)
                const navButtons = sidebar.querySelectorAll('.nav-btn');
                navButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        if (window.innerWidth < 1024) { // lg breakpoint
                            sidebar.classList.add('hidden');
                        }
                    });
                });
                
                // Ajustar visibilidade do menu ao redimensionar
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 1024) {
                        sidebar.classList.remove('hidden');
                    } else {
                        sidebar.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    <script src="../public/assets/js/admin.js"></script>
</body>
</html>