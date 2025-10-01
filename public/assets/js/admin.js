// public/assets/js/admin.js

const API_URL = 'loginVerification';

// FUNÇÕES DE LOGIN
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const dashboard = document.getElementById('dashboard');
    
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    if (dashboard) {
        // Se o dashboard está visível, a página carregou com o usuário já logado.
        // Então, mostramos a visão geral como padrão.
        showSection('overview', document.querySelector('.nav-btn'));
    }
});

async function handleLogin(e) {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const loginError = document.getElementById('loginError');

    try {
        const response = await fetch('authLogin', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password })
});
        const result = await response.json();
        
        if (result.success) {
            window.location.reload(); // Recarrega a página, o PHP mostrará o dashboard
        } else {
            loginError.textContent = result.message || 'Erro ao fazer login.';
            loginError.classList.remove('hidden');
        }
    } catch (error) {
        loginError.textContent = 'Ocorreu um erro de conexão.';
        loginError.classList.remove('hidden');
    }
}

// NAVEGAÇÃO
function showSection(section, element) {
    document.querySelectorAll('.section').forEach(s => s.classList.add('hidden'));
    document.getElementById(section + 'Section').classList.remove('hidden');
    
    document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('bg-indigo-100', 'text-indigo-600'));
    if (element) {
      element.classList.add('bg-indigo-100', 'text-indigo-600');
    }
    
    // Carrega os dados da seção correspondente
    switch (section) {
        case 'overview':
            loadOverview();
            break;
        case 'budgets':
            loadBudgets();
            break;
        case 'services':
            loadServices();
            break;
        case 'appointments':
            loadAppointments();
            break;
    }
}

// CARREGAMENTO DE DADOS (READ)
async function loadOverview() {
    const response = await fetch(`${API_URL}?entity=overview`);
    const data = await response.json();

    document.getElementById('totalBudgets').textContent = data.totalBudgets;
    document.getElementById('totalServices').textContent = data.totalServices;
    document.getElementById('totalAppointments').textContent = data.totalAppointments;
    document.getElementById('totalRevenue').textContent = data.totalRevenue;
}

async function loadBudgets() {
    const response = await fetch(`${API_URL}?entity=budgets`);
    const budgets = await response.json();
    renderBudgets(budgets);
}

async function loadServices() {
    const response = await fetch(`${API_URL}?entity=services`);
    const services = await response.json();
    renderServices(services);
}

async function loadAppointments() {
    const response = await fetch(`${API_URL}?entity=appointments`);
    const appointments = await response.json();
    renderAppointments(appointments);
}

// RENDERIZAÇÃO
function renderBudgets(budgets) {
    const tbody = document.getElementById('budgetsList');
    if (budgets.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum orçamento cadastrado</td></tr>';
        return;
    }
    tbody.innerHTML = budgets.map(budget => `
        <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">${budget.cliente}</td>
            <td class="py-3 px-4 text-sm text-gray-600">${budget.email}<br>${budget.telefone}</td>
            <td class="py-3 px-4 font-semibold">R$ ${parseFloat(budget.valor).toFixed(2).replace('.', ',')}</td>
            <td class="py-3 px-4"><span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">${budget.status}</span></td>
            <td class="py-3 px-4">
                <button onclick="deleteBudget(${budget.id})" class="text-red-600 hover:text-red-800">Excluir</button>
            </td>
        </tr>
    `).join('');
}

function renderServices(services) {
    const container = document.getElementById('servicesList');
    if (services.length === 0) {
        container.innerHTML = '<div class="text-center py-8 text-gray-500 col-span-3">Nenhum serviço cadastrado</div>';
        return;
    }
    container.innerHTML = services.map(service => `
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h4 class="font-semibold text-gray-800">${service.nome}</h4>
            <p class="text-sm text-gray-600 mb-3">${service.descricao || ''}</p>
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-green-600">R$ ${parseFloat(service.preco).toFixed(2).replace('.', ',')}</span>
                <button onclick="deleteService(${service.id})" class="text-xs bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button>
            </div>
        </div>
    `).join('');
}

function renderAppointments(appointments) {
    const tbody = document.getElementById('appointmentsList');
    if (appointments.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum agendamento cadastrado</td></tr>';
        return;
    }
    tbody.innerHTML = appointments.map(app => `
        <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">${app.cliente}</td>
            <td class="py-3 px-4">${app.serviceName}</td>
            <td class="py-3 px-4">${new Date(app.data_agendamento + 'T00:00:00').toLocaleDateString('pt-BR')} ${app.hora_agendamento.substring(0, 5)}</td>
            <td class="py-3 px-4"><span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">${app.status}</span></td>
            <td class="py-3 px-4">
                <button onclick="deleteAppointment(${app.id})" class="text-red-600 hover:text-red-800">Excluir</button>
            </td>
        </tr>
    `).join('');
}

// AÇÕES DE DELEÇÃO (DELETE)
async function deleteBudget(id) {
    if (confirm('Tem certeza que deseja excluir este orçamento?')) {
        await fetch(`${API_URL}?entity=budgets&id=${id}`, { method: 'DELETE' });
        loadBudgets(); // Recarrega a lista
    }
}

async function deleteService(id) {
    if (confirm('Tem certeza que deseja excluir este serviço?')) {
        await fetch(`${API_URL}?entity=services&id=${id}`, { method: 'DELETE' });
        loadServices(); // Recarrega a lista
    }
}

async function deleteAppointment(id) {
    if (confirm('Tem certeza que deseja excluir este agendamento?')) {
        await fetch(`${API_URL}?entity=appointments&id=${id}`, { method: 'DELETE' });
        loadAppointments(); // Recarrega a lista
    }
}