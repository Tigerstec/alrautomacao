<?php
namespace app\controllers;

use app\models\Orcamento;
use app\models\OrcamentoDAO;

class OrcamentoController {
    
    public function handleRequest($method, $id, $input) {
        $model = new OrcamentoDAO();

        switch ($method) {
            case 'GET':
                echo json_encode($model->getAll());
                break;
            case 'POST':
                // Cria objeto Orcamento com dados do formulário
                $orcamento = new Orcamento(
                    null,  // id (novo, banco gera)
                    $input['client'],
                    $input['email'],
                    $input['phone'],
                    $input['value'],
                    $input['description'],
                    $input['status'] ?? 'Cadastrado',
                    date('Y-m-d H:i:s')
                );
                $id = $model->create($orcamento);
                echo json_encode(['success' => true, 'id' => $id]);
                break;
            case 'PUT':
                if (!$id) throw new \Exception("ID necessário para atualização");
                // Cria objeto Orcamento com dados para atualização
                $orcamento = new Orcamento(
                    $id,
                    $input['client'],
                    $input['email'],
                    $input['phone'],
                    $input['value'],
                    $input['description'],
                    $input['status'],
                    null  // data_criacao não é alterada
                );
                $model->update($orcamento);
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