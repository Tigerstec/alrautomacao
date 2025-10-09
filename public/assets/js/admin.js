// VARIÁVEIS DE ESTADO
const editingIdField = document.getElementById('editingId');

// --- FUNÇÃO AUXILIAR PARA API ---
async function apiRequest(entity, method = 'GET', data = null, id = null) {
    let url = `/alrautomacao/app/controllers/api.php?entity=${entity}`;
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
            const response = await fetch('/alrautomacao/app/controllers/auth.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ username, password }) });
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
function showBudgetForm() { document.getElementById('budgetForm').classList.remove('hidden'); editingIdField.value = null; }
function hideBudgetForm() { document.getElementById('budgetForm').classList.add('hidden'); document.getElementById('budgetFormData').reset(); editingIdField.value = null; }
async function loadAndRenderBudgets() { try { const budgets = await apiRequest('budgets'); renderBudgets(budgets); } catch (e) { console.error("Falha ao carregar Orçamentos"); } }
function renderBudgets(budgets) { const tbody = document.getElementById('budgetsList'); if (!budgets || budgets.length === 0) { tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum orçamento</td></tr>'; return; } tbody.innerHTML = budgets.map(b => ` <tr class="border-b hover:bg-gray-50"> <td class="py-3 px-4">${b.cliente}</td> <td class="py-3 px-4">${b.email}</td> <td class="py-3 px-4">R$ ${parseFloat(b.valor).toFixed(2)}</td> <td class="py-3 px-4"><span class="px-2 py-1 text-xs rounded-full ${b.status === 'Aprovado' ? 'bg-green-100 text-green-800' : b.status === 'Rejeitado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}">${b.status}</span></td> <td class="py-3 px-4"> <button onclick='editBudget(${JSON.stringify(b)})' class="text-blue-600 hover:text-blue-800 mr-2">Editar</button> <button onclick="deleteBudget(${b.id})" class="text-red-600 hover:text-red-800">Excluir</button> </td> </tr>`).join(''); }
function editBudget(budget) { editingIdField.value = budget.id; document.getElementById('budgetClient').value = budget.cliente; document.getElementById('budgetEmail').value = budget.email; document.getElementById('budgetPhone').value = budget.telefone; document.getElementById('budgetValue').value = budget.valor; document.getElementById('budgetDescription').value = budget.descricao; showBudgetForm(); window.scrollTo(0, 0); }
async function deleteBudget(id) { if (confirm('Tem certeza?')) { await apiRequest('budgets', 'DELETE', null, id); await loadAndRenderBudgets(); } }
function showServiceForm() { document.getElementById('serviceForm').classList.remove('hidden'); editingIdField.value = null; }
function hideServiceForm() { document.getElementById('serviceForm').classList.add('hidden'); document.getElementById('serviceFormData').reset(); editingIdField.value = null; }
async function loadAndRenderServices() { try { const services = await apiRequest('services'); renderServices(services); return services; } catch (e) { console.error("Falha ao carregar Serviços"); return []; } }
function renderServices(services) { const container = document.getElementById('servicesList'); if (!services || services.length === 0) { container.innerHTML = '<div class="text-center py-8 text-gray-500 md:col-span-2 lg:col-span-3">Nenhum serviço</td></tr>'; return; } container.innerHTML = services.map(s => ` <div class="bg-gray-50 p-4 rounded-lg border"> <h4 class="font-semibold text-gray-800">${s.nome}</h4> <p class="text-sm text-gray-600 mb-3">${s.descricao || ''}</p> <div class="flex justify-between items-center mb-3"> <span class="text-lg font-bold text-green-600">R$ ${parseFloat(s.preco).toFixed(2)}</span> <span class="text-sm text-gray-500">${s.duracao} min</span> </div> <div class="flex space-x-2"> <button onclick='editService(${JSON.stringify(s)})' class="text-xs bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Editar</button> <button onclick="deleteService(${s.id})" class="text-xs bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Excluir</button> </div> </div>`).join(''); }
function editService(service) { editingIdField.value = service.id; document.getElementById('serviceName').value = service.nome; document.getElementById('serviceCategory').value = service.categoria; document.getElementById('servicePrice').value = service.preco; document.getElementById('serviceDuration').value = service.duracao; document.getElementById('serviceDescription').value = service.descricao; showServiceForm(); window.scrollTo(0, 0); }
async function deleteService(id) { if (confirm('Tem certeza?')) { await apiRequest('services', 'DELETE', null, id); await loadAndRenderServices(); } }
async function showAppointmentForm() { await updateAppointmentServiceOptions(); document.getElementById('appointmentForm').classList.remove('hidden'); editingIdField.value = null; }
function hideAppointmentForm() { document.getElementById('appointmentForm').classList.add('hidden'); document.getElementById('appointmentFormData').reset(); editingIdField.value = null; }
async function updateAppointmentServiceOptions() { const services = await loadAndRenderServices(); const select = document.getElementById('appointmentService'); select.innerHTML = '<option value="">Selecione um serviço</option>'; if (services) { services.forEach(service => { select.innerHTML += `<option value="${service.id}">${service.nome} - R$ ${parseFloat(service.preco).toFixed(2)}</option>`; }); } }
async function loadAndRenderAppointments() { try { await updateAppointmentServiceOptions(); const appointments = await apiRequest('appointments'); renderAppointments(appointments); } catch (e) { console.error("Falha ao carregar Agendamentos"); } }
function renderAppointments(appointments) { const tbody = document.getElementById('appointmentsList'); if (!appointments || appointments.length === 0) { tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-gray-500">Nenhum agendamento</td></tr>'; return; } tbody.innerHTML = appointments.map(a => ` <tr class="border-b hover:bg-gray-50"> <td class="py-3 px-4">${a.cliente}</td> <td class="py-3 px-4">${a.serviceName}</td> <td class="py-3 px-4">${new Date(a.data_agendamento + 'T00:00:00').toLocaleDateString('pt-BR')} ${a.hora_agendamento.substring(0, 5)}</td> <td class="py-3 px-4"><span class="px-2 py-1 text-xs rounded-full ${getStatusColor(a.status)}">${a.status}</span></td> <td class="py-3 px-4"> <button onclick='editAppointment(${JSON.stringify(a)})' class="text-blue-600 hover:text-blue-800 mr-2">Editar</button> <button onclick="deleteAppointment(${a.id})" class="text-red-600 hover:text-red-800">Excluir</button> </td> </tr>`).join(''); }
function getStatusColor(status) { const colors = { 'Agendado': 'bg-blue-100 text-blue-800', 'Confirmado': 'bg-green-100 text-green-800', 'Em Andamento': 'bg-yellow-100 text-yellow-800', 'Concluído': 'bg-purple-100 text-purple-800', 'Cancelado': 'bg-red-100 text-red-800' }; return colors[status] || 'bg-gray-100 text-gray-800'; }
function editAppointment(appointment) { editingIdField.value = appointment.id; document.getElementById('appointmentClient').value = appointment.cliente; document.getElementById('appointmentPhone').value = appointment.telefone; document.getElementById('appointmentService').value = appointment.servico_id; document.getElementById('appointmentDate').value = appointment.data_agendamento; document.getElementById('appointmentTime').value = appointment.hora_agendamento; document.getElementById('appointmentStatus').value = appointment.status; document.getElementById('appointmentNotes').value = appointment.observacoes; showAppointmentForm(); window.scrollTo(0, 0); }
async function deleteAppointment(id) { if (confirm('Tem certeza?')) { await apiRequest('appointments', 'DELETE', null, id); await loadAndRenderAppointments(); } }

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