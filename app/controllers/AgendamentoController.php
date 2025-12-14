<?php
namespace app\controllers;

use app\models\Agendamento;
use app\models\AgendamentoDAO;

class AgendamentoController {
    
    public function handleRequest($method, $id, $input) {
        $model = new AgendamentoDAO();

        switch ($method) {
            case 'GET':
                echo json_encode($model->getAll());
                break;
            case 'POST':
                // Cria objeto Agendamento com dados do formulário
                $agendamento = new Agendamento(
                    null,  // id (novo, banco gera)
                    $input['client'],
                    $input['phone'],
                    $input['serviceId'],
                    $input['date'],
                    $input['time'],
                    $input['status'],
                    $input['notes'],
                    null,  // serviceName (virá do banco)
                    null   // servicePrice (virá do banco)
                );
                $id = $model->create($agendamento);
                echo json_encode(['success' => true, 'id' => $id]);
                break;
            case 'PUT':
                if (!$id) throw new \Exception("ID necessário para atualização");
                // Cria objeto Agendamento com dados para atualização
                $agendamento = new Agendamento(
                    $id,
                    $input['client'],
                    $input['phone'],
                    $input['serviceId'],
                    $input['date'],
                    $input['time'],
                    $input['status'],
                    $input['notes'],
                    null,  // serviceName
                    null   // servicePrice
                );
                $model->update($agendamento);
                echo json_encode(['success' => true]);
                break;
            case 'DELETE':
                if (!$id) throw new \Exception("ID necessário para exclusão");
                $model->delete($id);
                echo json_encode(['success' => true]);
                break;
        }
    }
}