<?php
namespace app\models;

use core\database\DBConnection;
use PDO;

class servicoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = (new DBConnection())->getConn();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM servicos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['name'], $data['category'], $data['price'], $data['duration'], $data['description']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE servicos SET nome = ?, categoria = ?, preco = ?, duracao = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['category'], $data['price'], $data['duration'], $data['description'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM servicos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- MÉTODO PARA O DASHBOARD ---
    public function count() {
        return $this->pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();
    }
}