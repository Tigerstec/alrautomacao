<?php
namespace app\controllers;

use app\models\orcamentoDAO;
use app\models\servicoDAO;
use app\models\agendamentoDAO;

class overviewController {
    public function handleRequest() {
        // 1. Instancia os models
        $orcamentoModel = new orcamentoDAO();
        $servicoModel = new servicoDAO();
        $agendamentoModel = new agendamentoDAO();

        // 2. Busca as contagens (usando os métodos que garantimos que existem agora)
        $totalBudgets = $orcamentoModel->count();
        $totalServices = $servicoModel->count();
        $totalAppointments = $agendamentoModel->count();
        
        // 3. Calcula receita (Orçamentos Aprovados + Agendamentos Concluídos)
        $receitaOrcamentos = $orcamentoModel->sumApproved(); 
        
        // Verifica se o método sumRevenue existe no Agendamento, senão usa 0
        if (method_exists($agendamentoModel, 'sumRevenue')) {
            $receitaAgendamentos = $agendamentoModel->sumRevenue();
        } else {
            $receitaAgendamentos = 0;
        }

        $totalRevenue = ($receitaOrcamentos ?? 0) + ($receitaAgendamentos ?? 0);
        
        // 4. Retorna o JSON para o JavaScript
        echo json_encode([
            'totalBudgets' => $totalBudgets,
            'totalServices' => $totalServices,
            'totalAppointments' => $totalAppointments,
            'totalRevenue' => number_format($totalRevenue, 2, ',', '.')
        ]);
    }
}