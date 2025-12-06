<?php
namespace app\controllers;

use app\models\servicoDAO;

class servicoController {
    
    public function handleRequest($method, $id, $input) {
        $model = new servicoDAO();

        switch ($method) {
            case 'GET':
                echo json_encode($model->getAll());
                break;
            case 'POST':
                $id = $model->create($input);
                echo json_encode(['success' => true, 'id' => $id]);
                break;
            case 'PUT':
                if (!$id) throw new \Exception("ID necessário para atualização");
                $model->update($id, $input);
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