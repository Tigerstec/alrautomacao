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
    
    <div id="loginScreen" class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Acesso Administrativo</h1>
                <p class="text-gray-600 mt-2">Entre com suas credenciais</p>
                <p id="loginError" class="text-red-500 text-sm mt-2 hidden"></p>
            </div>
            
            <form id="loginForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuário</label>
                    <input type="text" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Digite seu usuário" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <input type="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Digite sua senha" required>
                </div>
                
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">
                    Entrar no Sistema
                </button>
            </form>
        </div>
    </div>

    <?php else: ?>

    <div id="dashboard">
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-xl font-bold text-gray-800">Painel Administrativo</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="logoutAction" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                        Sair
                    </a>
                </div>
            </div>
        </header>

        <div class="flex">
            <nav class="bg-white w-64 min-h-screen shadow-lg slide-in">
                <div class="p-6">
                    <ul class="space-y-2">
                        <li>
                            <button onclick="showSection('overview', this)" class="nav-btn w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3">
                                <span>Visão Geral</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('budgets', this)" class="nav-btn w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3">
                                <span>Orçamentos</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('services', this)" class="nav-btn w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3">
                                <span>Serviços</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('appointments', this)" class="nav-btn w-full text-left px-4 py-3 rounded-lg flex items-center space-x-3">
                                <span>Agendamentos</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="flex-1 p-6">
                <div id="overviewSection" class="section fade-in">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Visão Geral do Sistema</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <p class="text-sm text-gray-600">Total Orçamentos</p>
                            <p class="text-2xl font-bold text-gray-800" id="totalBudgets">0</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <p class="text-sm text-gray-600">Serviços Ativos</p>
                            <p class="text-2xl font-bold text-gray-800" id="totalServices">0</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <p class="text-sm text-gray-600">Agendamentos</p>
                            <p class="text-2xl font-bold text-gray-800" id="totalAppointments">0</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <p class="text-sm text-gray-600">Receita Total (Aprov./Concl.)</p>
                            <p class="text-2xl font-bold text-gray-800">R$ <span id="totalRevenue">0,00</span></p>
                        </div>
                    </div>
                </div>

                <div id="budgetsSection" class="section hidden">
                    <h2 class="text-2xl font-bold text-gray-800">Gestão de Orçamentos</h2>
                    
                    <div class="bg-white rounded-xl shadow-sm border mt-6">
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-3 px-4">Cliente</th>
                                            <th class="text-left py-3 px-4">Contato</th>
                                            <th class="text-left py-3 px-4">Valor</th>
                                            <th class="text-left py-3 px-4">Status</th>
                                            <th class="text-left py-3 px-4">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="budgetsList"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="servicesSection" class="section hidden">
                     <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Serviços</h2>
                        <button onclick="showServiceForm()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            + Novo Serviço
                        </button>
                    </div>

                    <div id="serviceForm" class="hidden bg-white p-6 rounded-xl shadow-sm border mb-6">
                        </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="servicesList"></div>
                        </div>
                    </div>
                </div>

                <div id="appointmentsSection" class="section hidden">
                     <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Agendamentos</h2>
                        <button onclick="showAppointmentForm()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            + Novo Agendamento
                        </button>
                    </div>

                     <div id="appointmentForm" class="hidden bg-white p-6 rounded-xl shadow-sm border mb-6">
                        </div>

                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-6">
                             <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b">
                                            <th class="text-left py-3 px-4">Cliente</th>
                                            <th class="text-left py-3 px-4">Serviço</th>
                                            <th class="text-left py-3 px-4">Data/Hora</th>
                                            <th class="text-left py-3 px-4">Status</th>
                                            <th class="text-left py-3 px-4">Ações</th>
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

    <script src="public/assets/js/admin.js"></script>
</body>
</html>