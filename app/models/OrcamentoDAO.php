<?php
namespace app\models;

use core\database\DBConnection;
use PDO;

class orcamentoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = (new DBConnection())->getConn();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT *, DATE_FORMAT(data_criacao, '%d/%m/%Y') as data_formatada FROM orcamentos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data['client'], $data['email'], $data['phone'], $data['value'], $data['description'], $data['status'] ?? 'Pendente']);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE orcamentos SET cliente = ?, email = ?, telefone = ?, valor = ?, descricao = ?, status = ? WHERE id = ?");
        return $stmt->execute([$data['client'], $data['email'], $data['phone'], $data['value'], $data['description'], $data['status'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM orcamentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // --- ESSES SÃO OS MÉTODOS QUE O DASHBOARD PRECISA ---
    
    public function count() {
        // Conta quantos orçamentos existem
        return $this->pdo->query("SELECT COUNT(*) FROM orcamentos")->fetchColumn();
    }
    
    public function sumApproved() {
        // Soma o valor apenas dos aprovados
        $result = $this->pdo->query("SELECT SUM(valor) FROM orcamentos WHERE status = 'Aprovado'")->fetchColumn();
        return $result ? $result : 0;
    }
}