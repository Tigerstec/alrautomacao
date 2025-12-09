<?php
namespace app\models;

use core\database\DBConnection;
use PDO;

class AgendamentoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = (new DBConnection())->getConn();
    }

    public function getAll() {
        // Busca agendamentos com dados do serviço (JOIN)
        $sql = "SELECT a.*, s.nome as serviceName, s.preco as servicePrice 
                FROM agendamentos a 
                JOIN servicos s ON a.servico_id = s.id 
                ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo agendamento no banco de dados
     * @param Agendamento $agendamento Objeto Agendamento com os dados
     * @return int 
     */
    public function create(Agendamento $agendamento) {
        $stmt = $this->pdo->prepare("INSERT INTO agendamentos (cliente, telefone, servico_id, data_agendamento, hora_agendamento, status, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $agendamento->getCliente(),
            $agendamento->getTelefone(),
            $agendamento->getServicoId(),
            $agendamento->getDataAgendamento(),
            $agendamento->getHoraAgendamento(),
            $agendamento->getStatus(),
            $agendamento->getObservacoes()
        ]);
        return $this->pdo->lastInsertId();
    }

    /**
     * Atualiza um agendamento existente
     * @param Agendamento $agendamento Objeto Agendamento com os dados
     * @return bool True se sucesso
     */
    public function update(Agendamento $agendamento) {
        $stmt = $this->pdo->prepare("UPDATE agendamentos SET cliente = ?, telefone = ?, servico_id = ?, data_agendamento = ?, hora_agendamento = ?, status = ?, observacoes = ? WHERE id = ?");
        return $stmt->execute([
            $agendamento->getCliente(),
            $agendamento->getTelefone(),
            $agendamento->getServicoId(),
            $agendamento->getDataAgendamento(),
            $agendamento->getHoraAgendamento(),
            $agendamento->getStatus(),
            $agendamento->getObservacoes(),
            $agendamento->getId()
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
        return $stmt->execute([$id]);
    }



    public function count() {
        return $this->pdo->query("SELECT COUNT(*) FROM agendamentos")->fetchColumn();
    }

    public function sumRevenue() {
        // Soma apenas agendamentos CONCLUÍDOS
        $sql = "SELECT SUM(s.preco) 
                FROM agendamentos a 
                JOIN servicos s ON a.servico_id = s.id 
                WHERE a.status = 'Concluído'";
        return $this->pdo->query($sql)->fetchColumn();
    }
}