<?php
session_start();

// Verifica se o usuário está logado
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Sistema de Gestão</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div id="loginScreen" class="min-h-screen flex items-center justify-center p-4 <?php echo $is_logged_in ? 'hidden' : ''; ?>">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="bg-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Acesso Administrativo</h1>
                <p class="text-gray-600 mt-2">Entre com suas credenciais</p>
            </div>
            
            <form id="loginForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuário</label>
                    <input type="text" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Digite seu usuário" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <input type="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Digite sua senha" required>
                </div>
                
                <div id="loginError" class="hidden p-3 bg-red-100 text-red-700 rounded-lg text-sm"></div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">
                    Entrar no Sistema
                </button>
                 <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-200 font-medium">
                    <a href="home">Voltar para página principal</a>
                </button>
            </form>
        </div>
    </div>

    <div id="dashboard" class="<?php echo !$is_logged_in ? 'hidden' : ''; ?>">
        <header class="bg-white shadow-sm border-b">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-600 w-10 h-10 rounded-lg flex items-center justify-center">
                         <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold text-gray-800">Painel Administrativo</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></span>
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
                            <button onclick="showSection('overview')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10"></path></svg>
                                <span>Visão Geral</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('budgets')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span>Orçamentos</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('services')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                <span>Serviços</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('appointments')" class="nav-btn w-full text-left px-4 py-3 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
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
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Orçamentos</p>
                                    <p class="text-2xl font-bold text-gray-800" id="totalBudgets">0</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-lg"><svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Serviços Ativos</p>
                                    <p class="text-2xl font-bold text-gray-800" id="totalServices">0</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-lg"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Agendamentos</p>
                                    <p class="text-2xl font-bold text-gray-800" id="totalAppointments">0</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-lg"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Receita Total</p>
                                    <p class="text-2xl font-bold text-gray-800">R$ <span id="totalRevenue">0,00</span></p>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-lg"><svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path></svg></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="budgetsSection" class="section hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Orçamentos</h2>
                        <button onclick="showBudgetForm()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">+ Novo Orçamento</button>
                    </div>
                    <div id="budgetForm" class="hidden bg-white p-6 rounded-xl shadow-sm border mb-6">
                        <h3 class="text-lg font-semibold mb-4">Criar Novo Orçamento</h3>
                        <form id="budgetFormData" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Cliente</label><input type="text" id="budgetClient" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Email</label><input type="email" id="budgetEmail" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label><input type="tel" id="budgetPhone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Valor (R$)</label><input type="number" id="budgetValue" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label><textarea id="budgetDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required></textarea></div>
                            <div class="md:col-span-2 flex space-x-4"><button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Salvar Orçamento</button><button type="button" onclick="hideBudgetForm()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Cancelar</button></div>
                        </form>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Orçamentos Cadastrados</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead><tr class="border-b"><th class="text-left py-3 px-4">Cliente</th><th class="text-left py-3 px-4">Email</th><th class="text-left py-3 px-4">Valor</th><th class="text-left py-3 px-4">Status</th><th class="text-left py-3 px-4">Ações</th></tr></thead>
                                    <tbody id="budgetsList"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="servicesSection" class="section hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Gestão de Serviços</h2>
                        <button onclick="showServiceForm()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Novo Serviço</button>
                    </div>
                    <div id="serviceForm" class="hidden bg-white p-6 rounded-xl shadow-sm border mb-6">
                        <h3 class="text-lg font-semibold mb-4">Criar Novo Serviço</h3>
                        <form id="serviceFormData" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Nome do Serviço</label><input type="text" id="serviceName" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label><select id="serviceCategory" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><option value="">Selecione</option><option value="consultoria">Consultoria</option><option value="desenvolvimento">Desenvolvimento</option><option value="design">Design</option><option value="marketing">Marketing</option><option value="outros">Outros</option></select></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label><input type="number" id="servicePrice" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Duração (minutos)</label><input type="number" id="serviceDuration" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label><textarea id="serviceDescription" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea></div>
                            <div class="md:col-span-2 flex space-x-4"><button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Salvar Serviço</button><button type="button" onclick="hideServiceForm()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Cancelar</button></div>
                        </form>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Serviços Cadastrados</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="servicesList"></div>
                        </div>
                    </div>
                </div>

                <div id="appointmentsSection" class="section hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Agendamentos de Serviços</h2>
                        <button onclick="showAppointmentForm()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Novo Agendamento</button>
                    </div>
                    <div id="appointmentForm" class="hidden bg-white p-6 rounded-xl shadow-sm border mb-6">
                        <h3 class="text-lg font-semibold mb-4">Agendar Serviço</h3>
                        <form id="appointmentFormData" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Cliente</label><input type="text" id="appointmentClient" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label><input type="tel" id="appointmentPhone" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Serviço</label><select id="appointmentService" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></select></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Data</label><input type="date" id="appointmentDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Horário</label><input type="time" id="appointmentTime" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required></div>
                            <div><label class="block text-sm font-medium text-gray-700 mb-2">Status</label><select id="appointmentStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required><option value="Agendado">Agendado</option><option value="Confirmado">Confirmado</option><option value="Em Andamento">Em Andamento</option><option value="Concluído">Concluído</option><option value="Cancelado">Cancelado</option></select></div>
                            <div class="md:col-span-2"><label class="block text-sm font-medium text-gray-700 mb-2">Observações</label><textarea id="appointmentNotes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea></div>
                            <div class="md:col-span-2 flex space-x-4"><button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">Salvar Agendamento</button><button type="button" onclick="hideAppointmentForm()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Cancelar</button></div>
                        </form>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Agendamentos</h3>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead><tr class="border-b"><th class="text-left py-3 px-4">Cliente</th><th class="text-left py-3 px-4">Serviço</th><th class="text-left py-3 px-4">Data/Hora</th><th class="text-left py-3 px-4">Status</th><th class="text-left py-3 px-4">Ações</th></tr></thead>
                                    <tbody id="appointmentsList"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <input type="hidden" id="editingId">

    <script src="../../alrautomacao/public/assets/js/admin.js"></script>
</body>
</html>