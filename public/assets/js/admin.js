// VARIÁVEIS DE ESTADO
const editingIdField = document.getElementById('editingId');

// --- FUNÇÃO AUXILIAR PARA API ---
async function apiRequest(entity, method = 'GET', data = null, id = null) {
    let url = `/api/json?entity=${entity}`;
    if (id) { url += `&id=${id}`; }
    const options = { method, headers: { 'Content-Type': 'application/json' } };
    if (data) { options.body = JSON.stringify(data); }
    try {
        const response = await fetch(url, options);
        if (response.status === 401) { window.location.reload(); return null; }
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
            const response = await fetch('/api/login', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify({ username, password }) 
            });
            const result = await response.json();
            if (result.success) {
                window.location.reload();
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

// --- FUNÇÕES CRUD (ORÇAMENTOS, SERVIÇOS, AGENDAMENTOS) ---

// ===================================================================
// 💰 ORÇAMENTOS (Budgets)
// ===================================================================

/** Mostra o formulário de orçamento para um NOVO item */
function showBudgetForm() { 
    document.getElementById('budgetForm').classList.remove('hidden'); 
    editingIdField.value = null; // Limpa o ID para garantir que é um novo item
}

/** Esconde e reseta o formulário de orçamento */
function hideBudgetForm() { 
    document.getElementById('budgetForm').classList.add('hidden'); 
    document.getElementById('budgetFormData').reset(); 
    editingIdField.value = null; 
}

/** Carrega os dados da API e chama a função de renderização */
async function loadAndRenderBudgets() { 
    try { 
        const budgets = await apiRequest('budgets'); 
        renderBudgets(budgets); 
    } catch (e) { 
        console.error("Falha ao carregar Orçamentos"); 
    } 
}

/** Desenha a lista de orçamentos na tabela */
function renderBudgets(budgets) { 
    const tbody = document.getElementById('budgetsList'); 
    if (!budgets || budgets.length === 0) { 
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum orçamento</td></tr>'; 
        return; 
    } 
    tbody.innerHTML = budgets.map(b => ` 
        <tr class="border-b hover:bg-gray-50"> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">${b.cliente}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">${b.email}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">R$ ${parseFloat(b.valor).toFixed(2)}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4"><span class="px-2 py-1 text-xs rounded-full ${b.status === 'Aprovado' ? 'bg-green-100 text-green-800' : b.status === 'Rejeitado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}">${b.status}</span></td> 
            <td class="py-2 md:py-3 px-2 md:px-4"> 
                <button onclick='editBudget(${JSON.stringify(b)})' class="text-blue-600 hover:text-blue-800 mr-1 md:mr-2 text-xs md:text-sm">Editar</button> 
                <button onclick="deleteBudget(${b.id})" class="text-red-600 hover:text-red-800 text-xs md:text-sm">Excluir</button> 
            </td> 
        </tr>`).join(''); 
}

/** * [CORRIGIDO] Preenche o formulário para EDIÇÃO de um orçamento.
 * Não chama mais showBudgetForm() para evitar limpar o ID.
 */
function editBudget(budget) { 
    editingIdField.value = budget.id; 
    document.getElementById('budgetClient').value = budget.cliente; 
    document.getElementById('budgetEmail').value = budget.email; 
    document.getElementById('budgetPhone').value = budget.telefone; 
    document.getElementById('budgetValue').value = budget.valor; 
    document.getElementById('budgetDescription').value = budget.descricao; 
    document.getElementById('budgetForm').classList.remove('hidden'); // Mostra o form diretamente
    window.scrollTo(0, 0); 
}

/** Deleta um orçamento pelo ID */
async function deleteBudget(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('budgets', 'DELETE', null, id); 
        await loadAndRenderBudgets(); 
    } 
}


// ===================================================================
// 🛠️ SERVIÇOS (Services)
// ===================================================================

/** Mostra o formulário de serviço para um NOVO item */
function showServiceForm() { 
    document.getElementById('serviceForm').classList.remove('hidden'); 
    editingIdField.value = null; // Limpa o ID
}

/** Esconde e reseta o formulário de serviço */
function hideServiceForm() { 
    document.getElementById('serviceForm').classList.add('hidden'); 
    document.getElementById('serviceFormData').reset(); 
    editingIdField.value = null; 
}

/** Carrega os dados da API e chama a função de renderização */
async function loadAndRenderServices() { 
    try { 
        const services = await apiRequest('services'); 
        renderServices(services); 
        return services; // Retorna para ser usado no form de agendamento
    } catch (e) { 
        console.error("Falha ao carregar Serviços"); 
        return []; 
    } 
}

/** Desenha os cards de serviços na tela */
function renderServices(services) { 
    const container = document.getElementById('servicesList'); 
    if (!services || services.length === 0) { 
        container.innerHTML = '<div class="text-center py-8 text-gray-500 md:col-span-2 lg:col-span-3">Nenhum serviço</td></tr>'; 
        return; 
    } 
    container.innerHTML = services.map(s => ` 
        <div class="bg-gray-50 p-4 rounded-lg border"> 
            <h4 class="font-semibold text-gray-800">${s.nome}</h4> 
            <p class="text-sm text-gray-600 mb-3">${s.descricao || ''}</p> 
            <div class="flex justify-between items-center mb-3"> 
                <span class="text-lg font-bold text-green-600">R$ ${parseFloat(s.preco).toFixed(2)}</span> 
                <span class="text-sm text-gray-500">${s.duracao} min</span> 
            </div> 
            <div class="flex space-x-2"> 
                <button onclick='editService(${JSON.stringify(s)})' class="text-xs bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Editar</button> 
                <button onclick="deleteService(${s.id})" class="text-xs bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button> 
            </div> 
        </div>`).join(''); 
}

/** * [CORRIGIDO] Preenche o formulário para EDIÇÃO de um serviço.
 * Não chama mais showServiceForm() para evitar limpar o ID.
 */
function editService(service) { 
    editingIdField.value = service.id; 
    document.getElementById('serviceName').value = service.nome; 
    document.getElementById('serviceCategory').value = service.categoria; 
    document.getElementById('servicePrice').value = service.preco; 
    document.getElementById('serviceDuration').value = service.duracao; 
    document.getElementById('serviceDescription').value = service.descricao; 
    document.getElementById('serviceForm').classList.remove('hidden'); // Mostra o form diretamente
    window.scrollTo(0, 0); 
}

/** Deleta um serviço pelo ID */
async function deleteService(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('services', 'DELETE', null, id); 
        await loadAndRenderServices(); 
    } 
}


// ===================================================================
// 🗓️ AGENDAMENTOS (Appointments)
// ===================================================================

/** Mostra o formulário de agendamento para um NOVO item */
async function showAppointmentForm() { 
    await updateAppointmentServiceOptions(); // Garante que os serviços estão carregados
    document.getElementById('appointmentForm').classList.remove('hidden'); 
    editingIdField.value = null; // Limpa o ID
}

/** Esconde e reseta o formulário de agendamento */
function hideAppointmentForm() { 
    document.getElementById('appointmentForm').classList.add('hidden'); 
    document.getElementById('appointmentFormData').reset(); 
    editingIdField.value = null; 
}

/** Atualiza o <select> de serviços no formulário de agendamento */
async function updateAppointmentServiceOptions() { 
    const services = await loadAndRenderServices(); 
    const select = document.getElementById('appointmentService'); 
    select.innerHTML = '<option value="">Selecione um serviço</option>'; 
    if (services) { 
        services.forEach(service => { 
            select.innerHTML += `<option value="${service.id}">${service.nome} - R$ ${parseFloat(service.preco).toFixed(2)}</option>`; 
        }); 
    } 
}

/** Carrega os dados da API e chama a função de renderização */
async function loadAndRenderAppointments() { 
    try { 
        await updateAppointmentServiceOptions(); // Garante que os serviços estão disponíveis para o <select>
        const appointments = await apiRequest('appointments'); 
        renderAppointments(appointments); 
    } catch (e) { 
        console.error("Falha ao carregar Agendamentos"); 
    } 
}

/** Desenha a lista de agendamentos na tabela */
function renderAppointments(appointments) { 
    const tbody = document.getElementById('appointmentsList'); 
    if (!appointments || appointments.length === 0) { 
        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum agendamento</td></tr>'; 
        return; 
    } 
    tbody.innerHTML = appointments.map(a => ` 
        <tr class="border-b hover:bg-gray-50"> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">${a.cliente}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">${a.serviceName}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4 text-xs md:text-sm">${new Date(a.data_agendamento + 'T00:00:00').toLocaleDateString('pt-BR')} ${a.hora_agendamento.substring(0, 5)}</td> 
            <td class="py-2 md:py-3 px-2 md:px-4"><span class="px-2 py-1 text-xs rounded-full ${getStatusColor(a.status)}">${a.status}</span></td> 
            <td class="py-2 md:py-3 px-2 md:px-4"> 
                <button onclick='editAppointment(${JSON.stringify(a)})' class="text-blue-600 hover:text-blue-800 mr-1 md:mr-2 text-xs md:text-sm">Editar</button> 
                <button onclick="deleteAppointment(${a.id})" class="text-red-600 hover:text-red-800 text-xs md:text-sm">Excluir</button> 
            </td> 
        </tr>`).join(''); 
}

/** Função auxiliar para retornar a cor do status */
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

/** * [CORRIGIDO] Preenche o formulário para EDIÇÃO de um agendamento.
 * Não chama mais showAppointmentForm() para evitar limpar o ID.
 */
async function editAppointment(appointment) { 
    await updateAppointmentServiceOptions(); // Garante que o <select> está carregado
    
    editingIdField.value = appointment.id; 
    document.getElementById('appointmentClient').value = appointment.cliente; 
    document.getElementById('appointmentPhone').value = appointment.telefone; 
    document.getElementById('appointmentService').value = appointment.servico_id; 
    document.getElementById('appointmentDate').value = appointment.data_agendamento; 
    document.getElementById('appointmentTime').value = appointment.hora_agendamento; 
    document.getElementById('appointmentStatus').value = appointment.status; 
    document.getElementById('appointmentNotes').value = appointment.observacoes; 
    
    document.getElementById('appointmentForm').classList.remove('hidden'); // Mostra o form diretamente
    window.scrollTo(0, 0); 
}

/** Deleta um agendamento pelo ID */
async function deleteAppointment(id) { 
    if (confirm('Tem certeza?')) { 
        await apiRequest('appointments', 'DELETE', null, id); 
        await loadAndRenderAppointments(); 
    } 
}



// --- INICIALIZAÇÃO ---
document.addEventListener('DOMContentLoaded', () => {
    const dashboard = document.getElementById('dashboard');
    if (dashboard && !dashboard.classList.contains('hidden')) {
        const budgetForm = document.getElementById('budgetFormData');
        if (budgetForm) { budgetForm.addEventListener('submit', async function(e) { e.preventDefault(); const data = { client: document.getElementById('budgetClient').value, email: document.getElementById('budgetEmail').value, phone: document.getElementById('budgetPhone').value, value: parseFloat(document.getElementById('budgetValue').value), description: document.getElementById('budgetDescription').value, status: 'Pendente' }; const id = editingIdField.value; if (id) { await apiRequest('budgets', 'PUT', data, id); } else { await apiRequest('budgets', 'POST', data); } hideBudgetForm(); await loadAndRenderBudgets(); }); }
        const serviceForm = document.getElementById('serviceFormData');
        if(serviceForm) { serviceForm.addEventListener('submit', async function(e) { e.preventDefault(); const data = { name: document.getElementById('serviceName').value, category: document.getElementById('serviceCategory').value, price: parseFloat(document.getElementById('servicePrice').value), duration: parseInt(document.getElementById('serviceDuration').value), description: document.getElementById('serviceDescription').value }; const id = editingIdField.value; if (id) { await apiRequest('services', 'PUT', data, id); } else { await apiRequest('services', 'POST', data); } hideServiceForm(); await loadAndRenderServices(); }); }
        const appointmentForm = document.getElementById('appointmentFormData');
        if(appointmentForm) { appointmentForm.addEventListener('submit', async function(e) { e.preventDefault(); const data = { client: document.getElementById('appointmentClient').value, phone: document.getElementById('appointmentPhone').value, serviceId: parseInt(document.getElementById('appointmentService').value), date: document.getElementById('appointmentDate').value, time: document.getElementById('appointmentTime').value, status: document.getElementById('appointmentStatus').value, notes: document.getElementById('appointmentNotes').value }; const id = editingIdField.value; if (id) { await apiRequest('appointments', 'PUT', data, id); } else { await apiRequest('appointments', 'POST', data); } hideAppointmentForm(); await loadAndRenderAppointments(); }); }
        
        showSection('overview');
        
        const dateInput = document.getElementById('appointmentDate');
        if(dateInput) { const today = new Date().toISOString().split('T')[0]; dateInput.setAttribute('min', today); }
    }
});

// ===================================================================
// 📱 MELHORIAS PARA DISPOSITIVOS MÓVEIS
// ===================================================================

// Previne o zoom duplo-toque em iOS
document.addEventListener('touchend', function(event) {
    const now = (new Date()).getTime();
    if (now - lastTouchEnd <= 300) {
        event.preventDefault();
    }
    lastTouchEnd = now;
}, false);
let lastTouchEnd = 0;

// Melhora o scroll em dispositivos móveis
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
            navigator.vibrate(10); // Vibração curta de 10ms
        });
    });
}

// Lazy loading para tabelas grandes
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
