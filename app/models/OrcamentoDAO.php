<?php
namespace app\models;

use core\database\DBConnection;
use PDO;

class OrcamentoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = (new DBConnection())->getConn();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT *, DATE_FORMAT(data_criacao, '%d/%m/%Y') as data_formatada FROM orcamentos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo orçamento no banco de dados
     * @param Orcamento $orcamento Objeto Orcamento com os dados
     * @return int ID do novo orçamento
     */
    public function create(Orcamento $orcamento) {
        $stmt = $this->pdo->prepare("INSERT INTO orcamentos (cliente, email, telefone, valor, descricao, status, data_criacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $orcamento->getCliente(),
            $orcamento->getEmail(),
            $orcamento->getTelefone(),
            $orcamento->getValor(),
            $orcamento->getDescricao(),
            $orcamento->getStatus(),
            date('Y-m-d H:i:s')
        ]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Atualiza um orçamento existente
     * @param Orcamento $orcamento Objeto Orcamento com os dados
     * @return bool True se sucesso
     */
    public function update(Orcamento $orcamento) {
        $stmt = $this->pdo->prepare("UPDATE orcamentos SET cliente = ?, email = ?, telefone = ?, valor = ?, descricao = ?, status = ? WHERE id = ?");
        return $stmt->execute([
            $orcamento->getCliente(),
            $orcamento->getEmail(),
            $orcamento->getTelefone(),
            $orcamento->getValor(),
            $orcamento->getDescricao(),
            $orcamento->getStatus(),
            $orcamento->getId()
        ]);
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