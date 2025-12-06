<?php

namespace app\models;

class Agendamento {
    private $id;
    private $cliente;
    private $telefone;
    private $servicoId;
    private $dataAgendamento;
    private $horaAgendamento;
    private $status;
    private $observacoes;
    private $serviceName;
    private $servicePrice;

    public function __construct($id = null, $cliente = null, $telefone = null, $servicoId = null, $dataAgendamento = null, $horaAgendamento = null, $status = null, $observacoes = null, $serviceName = null, $servicePrice = null) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->telefone = $telefone;
        $this->servicoId = $servicoId;
        $this->dataAgendamento = $dataAgendamento;
        $this->horaAgendamento = $horaAgendamento;
        $this->status = $status;
        $this->observacoes = $observacoes;
        $this->serviceName = $serviceName;
        $this->servicePrice = $servicePrice;
    }

    // Getters
    public function getId()                  { return $this->id; }
    public function getCliente()             { return $this->cliente; }
    public function getTelefone()            { return $this->telefone; }
    public function getServicoId()           { return $this->servicoId; }
    public function getDataAgendamento()     { return $this->dataAgendamento; }
    public function getHoraAgendamento()     { return $this->horaAgendamento; }
    public function getStatus()              { return $this->status; }
    public function getObservacoes()         { return $this->observacoes; }
    public function getServiceName()         { return $this->serviceName; }
    public function getServicePrice()        { return $this->servicePrice; }

    // Setters
    public function setId($id)                              { $this->id = $id; }
    public function setCliente($cliente)                    { $this->cliente = $cliente; }
    public function setTelefone($telefone)                  { $this->telefone = $telefone; }
    public function setServicoId($servicoId)                { $this->servicoId = $servicoId; }
    public function setDataAgendamento($dataAgendamento)    { $this->dataAgendamento = $dataAgendamento; }
    public function setHoraAgendamento($horaAgendamento)    { $this->horaAgendamento = $horaAgendamento; }
    public function setStatus($status)                      { $this->status = $status; }
    public function setObservacoes($observacoes)            { $this->observacoes = $observacoes; }
    public function setServiceName($serviceName)            { $this->serviceName = $serviceName; }
    public function setServicePrice($servicePrice)          { $this->servicePrice = $servicePrice; }

    public function toArray() {
      return [
        'id' => $this->id,
        'cliente' => $this->cliente,
        'telefone' => $this->telefone,
        'servicoId' => $this->servicoId,
        'dataAgendamento' => $this->dataAgendamento,
        'horaAgendamento' => $this->horaAgendamento,
        'status' => $this->status,
        'observacoes' => $this->observacoes,
        'serviceName' => $this->serviceName,
        'servicePrice' => $this->servicePrice
      ];
    }
}
