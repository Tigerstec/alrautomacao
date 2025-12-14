<?php
namespace app\controllers;

use app\models\Servico;
use app\models\ServicoDAO;

class ServicoController {
    
    public function handleRequest($method, $id, $input) {
        $model = new ServicoDAO();

        switch ($method) {
            case 'GET':
                echo json_encode($model->getAll());
                break;
            case 'POST':
                // Cria objeto Servico com dados do formulário
                $servico = new Servico(
                    null,  // id (novo, banco gera)
                    $input['name'],
                    $input['category'],
                    $input['price'],
                    $input['duration'],
                    $input['description']
                );
                $id = $model->create($servico);
                echo json_encode(['success' => true, 'id' => $id]);
                break;
            case 'PUT':
                if (!$id) throw new \Exception("ID necessário para atualização");
                // Cria objeto Servico com dados para atualização
                $servico = new Servico(
                    $id,
                    $input['name'],
                    $input['category'],
                    $input['price'],
                    $input['duration'],
                    $input['description']
                );
                $model->update($servico);
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