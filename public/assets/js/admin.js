// VERIFICAÇÃO DE AUTENTICAÇÃO NO CARREGAMENTO
async function checkAuth() {
    try {
        const response = await fetch('api-check-auth', { method: 'GET' });
        const result = await response.json();
        
        console.log('Resultado da autenticação:', result);
        
        if (result.authenticated) {
            const userName = result.userName || localStorage.getItem('userName') || 'Admin';
            localStorage.setItem('userName', userName);
            showDashboard(userName);
        } else {
            localStorage.removeItem('userName');
            showLoginScreen();
        }
    } catch (error) {
        console.error('Erro ao verificar autenticação:', error);
        showLoginScreen();
    }
}

function showDashboard(userName) {
    document.getElementById('loginScreen').classList.add('hidden');
    document.getElementById('dashboard').classList.remove('hidden');
    const userGreeting = document.getElementById('userGreeting');
    userGreeting.textContent = `Bem-vindo, ${userName}`;
    showSection('overview');
}

function showLoginScreen() {
    document.getElementById('loginScreen').classList.remove('hidden');
    document.getElementById('dashboard').classList.add('hidden');
}

async function logout() {
    try {
        await fetch('api-logout', { method: 'GET' });
        showLoginScreen();
        document.getElementById('loginForm').reset();
    } catch (error) {
        console.error('Erro ao fazer logout:', error);
    }
}

// VARIÁVEIS DE ESTADO
const editingIdField = document.getElementById('editingId');


//MobileBTN
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const closeSidebarBtn = document.getElementById('closeSidebarBtn');
const sidebar = document.getElementById('sidebar');
const mobileOverlay = document.getElementById('mobileOverlay');

function openMobileMenu() {
    sidebar.classList.add('active');
    mobileOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeMobileMenu() {
    sidebar.classList.remove('active');
    mobileOverlay.classList.remove('active');
    document.body.style.overflow = ''
}

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', openMobileMenu);
}

if (closeSidebarBtn) {
    closeSidebarBtn.addEventListener('click', closeMobileMenu);
}

if (mobileOverlay) {
    mobileOverlay.addEventListener('click', closeMobileMenu);
}

document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Verifica se é mobile (largura < 768px)
        if (window.innerWidth < 768) {
            closeMobileMenu();
        }
    });
});


// --- FUNÇÃO AUXILIAR PARA API ---
async function apiRequest(entity, method = 'GET', data = null, id = null) {
    let url = `api-dados?entity=${entity}`;
    if (id) { url += `&id=${id}`; }
    const options = { method, headers: { 'Content-Type': 'application/json' } };
    if (data) { options.body = JSON.stringify(data); }
    try {
        const response = await fetch(url, options);
        if (response.status === 401) { 
            showLoginScreen(); 
            return null; 
        }
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            return response.json();
        } else {
            const textResponse = await response.text();
            throw new Error("A resposta não é um JSON válido. Resposta: " + textResponse.slice(0, 200));
        }
    } catch (error) {
        console.error(`Erro na requisição API para '${entity}':`, error);
        alert(`Ocorreu um erro ao comunicar com a API para '${entity}'. Verifique o console.`);
        throw error;
    }
}

// --- SISTEMA DE LOGIN ---
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const errorDiv = document.getElementById('loginError');
        errorDiv.classList.add('hidden');
        try {
            const response = await fetch('api-login', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify({ username, password }) 
            });
            const result = await response.json();
            if (result.success) {
                if (result.userName) {
                    localStorage.setItem('userName', result.userName);
                }
                showDashboard(result.userName);
            } else {
                errorDiv.textContent = result.message || 'Credenciais inválidas.';
                errorDiv.classList.remove('hidden');
            }
        } catch (error) {
            errorDiv.textContent = 'Erro de conexão com o servidor.';
            errorDiv.classList.remove('hidden');
        }
    });
}

// --- NAVEGAÇÃO E CARREGAMENTO DE DADOS ---
async function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(s => s.classList.add('hidden'));
    document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('bg-indigo-100', 'text-indigo-600'));
    const sectionElement = document.getElementById(sectionId + 'Section');
    if (sectionElement) { sectionElement.classList.remove('hidden'); }
    const activeBtn = document.querySelector(`button[onclick="showSection('${sectionId}')"]`);
    if (activeBtn) { activeBtn.classList.add('bg-indigo-100', 'text-indigo-600'); }
    
    // O try-catch foi movido para dentro de cada função de carregamento para erros mais específicos
    switch (sectionId) {
        case 'overview': await updateOverview(); break;
        case 'budgets': await loadAndRenderBudgets(); break;
        case 'services': await loadAndRenderServices(); break;
        case 'appointments': await loadAndRenderAppointments(); break;
    }
}

// --- VISÃO GERAL (OVERVIEW) ---
async function updateOverview() {
    try {
        const data = await apiRequest('overview');
        if (!data) return;

        const totalBudgetsEl = document.getElementById('totalBudgets');
        if (totalBudgetsEl) totalBudgetsEl.textContent = data.totalBudgets;

        const totalServicesEl = document.getElementById('totalServices');
        if (totalServicesEl) totalServicesEl.textContent = data.totalServices;

        const totalAppointmentsEl = document.getElementById('totalAppointments');
        if (totalAppointmentsEl) totalAppointmentsEl.textContent = data.totalAppointments;

        const totalRevenueEl = document.getElementById('totalRevenue');
        if (totalRevenueEl) totalRevenueEl.textContent = data.totalRevenue;
    } catch (error) {
        console.error("Falha ao carregar dados para a seção: Visão Geral", error);
    }
}


// Formata visualmente enquanto digita (1200000 -> 12.000,00)
function formatarMoeda(i) {
    let v = i.value.replace(/\D/g,'');
    v = (v/100).toFixed(2) + '';
    v = v.replace(".", ",");
    v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    i.value = v;
}

function converterMoedaParaFloat(valor) {
    if (!valor) return 0;
    return parseFloat(valor.replace(/\./g, '').replace(',', '.'));
}

function showBudgetForm() { 
    document.getElementById('budgetForm').classList.remove('hidden'); 
    editingIdField.value = null; // Limpa o ID para garantir que é um novo item
}

function hideBudgetForm() { 
    document.getElementById('budgetForm').classList.add('hidden'); 
    document.getElementById('budgetFormData').reset(); 
    editingIdField.value = null; 
}

async function loadAndRenderBudgets() { 
    try { 
        const budgets = await apiRequest('budgets'); 
        renderBudgets(budgets); 
    } catch (e) { 
        console.error("Falha ao carregar Orçamentos"); 
    } 
}

/** Desenha a lista de orçamentos em cards responsivos */
function renderBudgets(budgets) { 
    const container = document.getElementById('budgetsList'); 
    if (!budgets || budgets.length === 0) { 
        container.innerHTML = '<div class="text-center py-8 text-gray-500 md:col-span-2 lg:col-span-3">Nenhum orçamento cadastrado</div>'; 
        return; 
    } 
    container.innerHTML = budgets.map(b => ` 
        <div class="bg-gray-50 p-4 rounded-lg border hover:shadow-md transition-shadow"> 
            <div class="flex justify-between items-start mb-3">
                <h4 class="font-semibold text-gray-800 text-base">${b.cliente}</h4> 
                <span class="px-2 py-1 text-xs rounded-full ${b.status === 'Aprovado' ? 'bg-green-100 text-green-800' : b.status === 'Rejeitado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}">${b.status}</span>
            </div>
            <p class="text-sm text-gray-600 mb-2">${b.email}</p> 
            <p class="text-xs text-gray-500 mb-3">${b.telefone}</p> 
            <p class="text-sm text-gray-700 mb-3 line-clamp-2">${b.descricao || ''}</p> 
            <div class="flex justify-between items-center mb-3"> 
                    <span class="text-lg font-bold text-green-600">R$ ${parseFloat(b.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</span> 
            </div> 
            <div class="flex flex-col gap-2"> 
                <button onclick='createServiceFromBudget(${JSON.stringify(b)})' class="w-full text-xs bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600 transition-colors flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Criar Serviço
                </button> 
                <div class="flex gap-2">
                    <button onclick='editBudget(${JSON.stringify(b)})' class="flex-1 text-xs bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition-colors">Editar</button> 
                    <button onclick="deleteBudget(${b.id})" class="flex-1 text-xs bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition-colors">Excluir</button> 
                </div>
            </div> 
        </div>`).join(''); 
}

function editBudget(budget) { 
    editingIdField.value = budget.id; 
    document.getElementById('budgetClient').value = budget.cliente; 
    document.getElementById('budgetEmail').value = budget.email; 
    document.getElementById('budgetPhone').value = budget.telefone; 
    let valorFormatado = parseFloat(budget.valor).toFixed(2).replace('.', ',');
    valorFormatado = valorFormatado.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    document.getElementById('budgetValue').value = valorFormatado; 
    
    document.getElementById('budgetDescription').value = budget.descricao; 
    document.getElementById('budgetForm').classList.remove('hidden'); 
    window.scrollTo(0, 0);
}

async function deleteBudget(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('budgets', 'DELETE', null, id); 
        await loadAndRenderBudgets(); 
    } 
}


function showServiceForm() { 
    updateBudgetSelector();
    document.getElementById('serviceForm').classList.remove('hidden'); 
    editingIdField.value = null; // Limpa o ID
}

// Atualiza o seletor de orçamentos no formulário de serviços
async function updateBudgetSelector() {
    try {
        const budgets = await apiRequest('budgets');
        const select = document.getElementById('budgetSelector');
        if (select && budgets) {
            select.innerHTML = '<option value="">Selecione um orçamento (opcional)</option>';
            budgets.forEach(budget => {
                select.innerHTML += `<option value="${budget.id}" data-budget='${JSON.stringify(budget)}'>Cliente: ${budget.cliente} - R$ ${parseFloat(budget.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</option>`;
            });
        }
    } catch (error) {
        console.error('Erro ao carregar orçamentos:', error);
    }
}

// Preenche o formulário de serviço com dados de um orçamento selecionado
function fillServiceFromBudget() {
    const select = document.getElementById('budgetSelector');
    const selectedOption = select.options[select.selectedIndex];
    
    if (selectedOption.value) {
        const budget = JSON.parse(selectedOption.getAttribute('data-budget'));
        
        // Preenche o nome do serviço com o nome do cliente e descrição
        document.getElementById('serviceName').value = `Serviço - ${budget.cliente}`;
        
        // Preenche o preço com o valor do orçamento
        let valorFormatado = parseFloat(budget.valor).toFixed(2).replace('.', ',');
        valorFormatado = valorFormatado.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        document.getElementById('servicePrice').value = valorFormatado;
        
        // Preenche a descrição
        document.getElementById('serviceDescription').value = budget.descricao || '';
        
        // Adiciona informações do cliente na descrição
        const descricaoAtual = document.getElementById('serviceDescription').value;
        const infoCliente = `\n\n--- Informações do Orçamento ---\nCliente: ${budget.cliente}\nEmail: ${budget.email}\nTelefone: ${budget.telefone}`;
        document.getElementById('serviceDescription').value = descricaoAtual + infoCliente;
    }
}

// Cria um serviço diretamente a partir de um orçamento
function createServiceFromBudget(budget) {
    // Muda para a seção de serviços
    showSection('services');
    
    // Aguarda um pequeno delay para garantir que a seção foi carregada
    setTimeout(() => {
        // Abre o formulário de serviço
        showServiceForm();
        
        // Aguarda outro delay para garantir que o formulário foi renderizado
        setTimeout(() => {
            // Preenche o formulário com os dados do orçamento
            document.getElementById('serviceName').value = `Serviço - ${budget.cliente}`;
            
            let valorFormatado = parseFloat(budget.valor).toFixed(2).replace('.', ',');
            valorFormatado = valorFormatado.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            document.getElementById('servicePrice').value = valorFormatado;
            
            document.getElementById('serviceDescription').value = `${budget.descricao || ''}\n\n--- Informações do Orçamento ---\nCliente: ${budget.cliente}\nEmail: ${budget.email}\nTelefone: ${budget.telefone}\nValor Original: R$ ${parseFloat(budget.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
            
            // Sugestão de duração padrão (120 minutos)
            document.getElementById('serviceDuration').value = 120;
            
            // Scroll suave para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Destaca o formulário com uma animação
            const form = document.getElementById('serviceForm');
            form.style.animation = 'pulse 0.5s';
            setTimeout(() => { form.style.animation = ''; }, 500);
        }, 100);
    }, 100);
}

function hideServiceForm() { 
    document.getElementById('serviceForm').classList.add('hidden'); 
    document.getElementById('serviceFormData').reset(); 
    editingIdField.value = null; 
}


async function loadAndRenderServices() { 
    try { 
        const services = await apiRequest('services'); 
        renderServices(services); 
        return services; 
    } catch (e) { 
        console.error("Falha ao carregar Serviços"); 
        return []; 
    } 
}

/** Desenha os cards de serviços na tela */
function renderServices(services) { 
    const container = document.getElementById('servicesList'); 
    if (!services || services.length === 0) { 
        container.innerHTML = '<div class="text-center py-8 text-gray-500 md:col-span-2 lg:col-span-3">Nenhum serviço</div>'; 
        return; 
    } 
    container.innerHTML = services.map(s => ` 
        <div class="bg-gray-50 p-4 rounded-lg border"> 
            <h4 class="font-semibold text-gray-800">${s.nome}</h4> 
            <p class="text-sm text-gray-600 mb-3 line-clamp-2">${s.descricao || ''}</p> 
            <div class="flex justify-between items-center mb-3"> 
                <span class="text-lg font-bold text-green-600">R$ ${parseFloat(s.preco).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</span>
                <span class="text-sm text-gray-500">${s.duracao} min</span> 
            </div> 
            <div class="flex space-x-2"> 
                <button onclick='editService(${JSON.stringify(s)})' class="text-xs bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Editar</button> 
                <button onclick="deleteService(${s.id})" class="text-xs bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button> 
            </div> 
        </div>`).join(''); 
}

function editService(service) { 
    editingIdField.value = service.id; 
    document.getElementById('serviceName').value = service.nome; 
    document.getElementById('serviceCategory').value = service.categoria; 
    let valorFormatado = parseFloat(service.preco).toFixed(2).replace('.', ',');
    valorFormatado = valorFormatado.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    document.getElementById('servicePrice').value = valorFormatado; 
    document.getElementById('serviceDuration').value = service.duracao; 
    document.getElementById('serviceDescription').value = service.descricao; 
    document.getElementById('serviceForm').classList.remove('hidden'); 
    window.scrollTo(0, 0); 
}


async function deleteService(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('services', 'DELETE', null, id); 
        await loadAndRenderServices(); 
    } 
}


async function showAppointmentForm() { 
    await updateAppointmentServiceOptions(); 
    document.getElementById('appointmentForm').classList.remove('hidden'); 
    editingIdField.value = null; 
}


function hideAppointmentForm() { 
    document.getElementById('appointmentForm').classList.add('hidden'); 
    document.getElementById('appointmentFormData').reset(); 
    editingIdField.value = null; 
}


async function updateAppointmentServiceOptions() { 
    const services = await loadAndRenderServices(); 
    const select = document.getElementById('appointmentService'); 
    select.innerHTML = '<option value="">Selecione um serviço</option>'; 
    if (services) { 
        services.forEach(service => { 
            select.innerHTML += `<option value="${service.id}">${service.nome} - R$ ${parseFloat(service.preco).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</option>`;
        }); 
    } 
}

// Variável global para armazenar agendamentos
let allAppointments = [];

async function loadAndRenderAppointments() { 
    try { 
        await updateAppointmentServiceOptions(); 
        const appointments = await apiRequest('appointments'); 
        allAppointments = appointments || []; // Armazena globalmente
        renderAppointments(appointments); 
    } catch (e) { 
        console.error("Falha ao carregar Agendamentos"); 
    } 
}

function renderAppointments(appointments) { 
    const container = document.getElementById('appointmentsList'); 
    if (!appointments || appointments.length === 0) { 
        container.innerHTML = '<div class="text-center py-8 text-gray-500 md:col-span-2 lg:col-span-3">Nenhum agendamento</div>'; 
        return; 
    } 
    container.innerHTML = appointments.map(a => ` 
        <div class="bg-gray-50 p-4 rounded-lg border hover:shadow-md transition-shadow"> 
            <div class="flex justify-between items-start mb-3">
                <h4 class="font-semibold text-gray-800 text-base">${a.cliente}</h4> 
                <span class="px-2 py-1 text-xs rounded-full ${getStatusColor(a.status)}">${a.status}</span>
            </div>
            
            <!-- Informações do Serviço -->
            <div class="bg-indigo-50 p-2 rounded-lg mb-3">
                <p class="text-sm font-semibold text-indigo-700 mb-1">⚡ ${a.serviceName}</p>
                ${a.servicePrice ? `<p class="text-xs text-indigo-600">💰 R$ ${parseFloat(a.servicePrice).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</p>` : ''}
                ${a.serviceDuration ? `<p class="text-xs text-indigo-600">⏱️ Duração: ${a.serviceDuration} minutos</p>` : ''}
            </div>
            
            <!-- Informações do Agendamento -->
            <p class="text-xs text-gray-600 mb-2">📅 ${new Date(a.data_agendamento + 'T00:00:00').toLocaleDateString('pt-BR')}</p> 
            <p class="text-xs text-gray-600 mb-2">🕐 ${a.hora_agendamento.substring(0, 5)}</p> 
            <p class="text-xs text-gray-600 mb-3">📞 ${a.telefone}</p> 
            ${a.observacoes ? `<p class="text-sm text-gray-700 mb-3 line-clamp-2">${a.observacoes}</p>` : ''} 
            
            <div class="flex gap-2"> 
                <button onclick='editAppointment(${JSON.stringify(a)})' class="flex-1 text-xs bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 transition-colors">Editar</button> 
                <button onclick="deleteAppointment(${a.id})" class="flex-1 text-xs bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition-colors">Excluir</button> 
            </div> 
        </div>`).join(''); 
}


function getStatusColor(status) { 
    const colors = { 
        'Agendado': 'bg-blue-100 text-blue-800', 
        'Confirmado': 'bg-green-100 text-green-800', 
        'Em Andamento': 'bg-yellow-100 text-yellow-800', 
        'Concluído': 'bg-purple-100 text-purple-800', 
        'Cancelado': 'bg-red-100 text-red-800' 
    }; 
    return colors[status] || 'bg-gray-100 text-gray-800'; 
}

async function editAppointment(appointment) { 
    await updateAppointmentServiceOptions(); 
    
    editingIdField.value = appointment.id; 
    document.getElementById('appointmentClient').value = appointment.cliente; 
    document.getElementById('appointmentPhone').value = appointment.telefone; 
    document.getElementById('appointmentService').value = appointment.servico_id; 
    document.getElementById('appointmentDate').value = appointment.data_agendamento; 
    document.getElementById('appointmentTime').value = appointment.hora_agendamento; 
    document.getElementById('appointmentStatus').value = appointment.status; 
    document.getElementById('appointmentNotes').value = appointment.observacoes; 
    
    document.getElementById('appointmentForm').classList.remove('hidden');
    window.scrollTo(0, 0); 
}


async function deleteAppointment(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('appointments', 'DELETE', null, id); 
        await loadAndRenderAppointments(); 
    } 
}

// Função para verificar se existe conflito de horário
function checkAppointmentConflict(date, time, excludeId = null) {
    return allAppointments.some(appointment => {
        // Ignora o agendamento atual ao editar
        if (excludeId && appointment.id == excludeId) {
            return false;
        }
        
        // Verifica se a data e hora são iguais
        return appointment.data_agendamento === date && 
               appointment.hora_agendamento === time;
    });
}

// Função auxiliar para verificar se data/hora foram alteradas durante edição
async function checkIfDateTimeChanged(appointmentId, newDate, newTime) {
    const appointment = allAppointments.find(a => a.id == appointmentId);
    if (!appointment) return true; // Se não encontrar, considera como novo
    
    return appointment.data_agendamento !== newDate || 
           appointment.hora_agendamento !== newTime;
}


document.addEventListener('DOMContentLoaded', () => {
    checkAuth();
    
    const budgetForm = document.getElementById('budgetFormData');
    if (budgetForm) { budgetForm.addEventListener('submit', async function(e) { e.preventDefault(); const data = { client: document.getElementById('budgetClient').value, email: document.getElementById('budgetEmail').value, phone: document.getElementById('budgetPhone').value, value: converterMoedaParaFloat(document.getElementById('budgetValue').value), description: document.getElementById('budgetDescription').value, status: 'Cadastrado' }; const id = editingIdField.value; if (id) { await apiRequest('budgets', 'PUT', data, id); } else { await apiRequest('budgets', 'POST', data); } hideBudgetForm(); await loadAndRenderBudgets(); }); }
    const serviceForm = document.getElementById('serviceFormData');
    if(serviceForm) { serviceForm.addEventListener('submit', async function(e) { e.preventDefault(); const data = { name: document.getElementById('serviceName').value, category: document.getElementById('serviceCategory').value, price: converterMoedaParaFloat(document.getElementById('servicePrice').value), duration: parseInt(document.getElementById('serviceDuration').value), description: document.getElementById('serviceDescription').value }; const id = editingIdField.value; if (id) { await apiRequest('services', 'PUT', data, id); } else { await apiRequest('services', 'POST', data); } hideServiceForm(); await loadAndRenderServices(); }); }
    const appointmentForm = document.getElementById('appointmentFormData');
    if(appointmentForm) { appointmentForm.addEventListener('submit', async function(e) { 
        e.preventDefault(); 
        
        const data = { 
            client: document.getElementById('appointmentClient').value, 
            phone: document.getElementById('appointmentPhone').value, 
            serviceId: parseInt(document.getElementById('appointmentService').value), 
            date: document.getElementById('appointmentDate').value, 
            time: document.getElementById('appointmentTime').value, 
            status: document.getElementById('appointmentStatus').value, 
            notes: document.getElementById('appointmentNotes').value 
        }; 
        
        const id = editingIdField.value; 
        
        // Validação de conflito de horário (apenas para novos agendamentos ou ao alterar data/hora)
        if (!id || await checkIfDateTimeChanged(id, data.date, data.time)) {
            const hasConflict = checkAppointmentConflict(data.date, data.time, id);
            if (hasConflict) {
                alert('❌ Já existe um agendamento nesse dia e horário!\n\nPor favor, escolha outro horário.');
                return; // Impede o envio do formulário
            }
        }
        
        if (id) { 
            await apiRequest('appointments', 'PUT', data, id); 
        } else { 
            await apiRequest('appointments', 'POST', data); 
        } 
        
        hideAppointmentForm(); 
        await loadAndRenderAppointments(); 
    }); }
    
    const dateInput = document.getElementById('appointmentDate');
    if(dateInput) { const today = new Date().toISOString().split('T')[0]; dateInput.setAttribute('min', today); }
});

document.addEventListener('touchend', function(event) {
    const now = (new Date()).getTime();
    if (now - lastTouchEnd <= 300) {
        event.preventDefault();
    }
    lastTouchEnd = now;
}, false);
let lastTouchEnd = 0;


if ('ontouchstart' in window) {
    document.body.style.webkitOverflowScrolling = 'touch';
}

// Ajusta altura de viewport em mobile (previne problemas com barra de navegação)
function setViewportHeight() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

window.addEventListener('resize', setViewportHeight);
window.addEventListener('orientationchange', setViewportHeight);
setViewportHeight();

// Fecha modais/formulários ao pressionar ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideBudgetForm();
        hideServiceForm();
        hideAppointmentForm();
        closeMobileMenu();
    }
});

// Função auxiliar para fechar menu mobile
function closeMobileMenu() {
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');
    if (sidebar) sidebar.classList.remove('active');
    if (mobileOverlay) mobileOverlay.classList.remove('active');
    document.body.style.overflow = '';
}

// Adiciona feedback tátil em botões (para dispositivos que suportam)
if ('vibrate' in navigator) {
    document.querySelectorAll('button, .btn').forEach(button => {
        button.addEventListener('click', function() {
            navigator.vibrate(10); 
        });
    });
}


const observerOptions = {
    root: null,
    rootMargin: '50px',
    threshold: 0.1
};

const tableObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Aplica observer quando tabelas são criadas
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('table').forEach(table => {
        tableObserver.observe(table);
    });
});
