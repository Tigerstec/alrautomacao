<?php
namespace app\models;

use core\database\DBConnection;
use PDO;

class ServicoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = (new DBConnection())->getConn();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM servicos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo serviço no banco de dados
     * @param Servico $servico Objeto Servico com os dados
     * @return int ID do novo serviço
     */
    public function create(Servico $servico) {
        $stmt = $this->pdo->prepare("INSERT INTO servicos (nome, categoria, preco, duracao, descricao) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $servico->getNome(),
            $servico->getCategoria(),
            $servico->getPreco(),
            $servico->getDuracao(),
            $servico->getDescricao()
        ]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Atualiza um serviço existente
     * @param Servico $servico Objeto Servico com os dados
     * @return bool True se sucesso
     */
    public function update(Servico $servico) {
        $stmt = $this->pdo->prepare("UPDATE servicos SET nome = ?, categoria = ?, preco = ?, duracao = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([
            $servico->getNome(),
            $servico->getCategoria(),
            $servico->getPreco(),
            $servico->getDuracao(),
            $servico->getDescricao(),
            $servico->getId()
        ]);
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