<?php

namespace app\models;

class Orcamento {
    private $id;
    private $cliente;
    private $email;
    private $telefone;
    private $valor;
    private $descricao;
    private $status;
    private $dataCriacao;

    public function __construct($id = null, $cliente = null, $email = null, $telefone = null, $valor = null, $descricao = null, $status = null, $dataCriacao = null) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->status = $status;
        $this->dataCriacao = $dataCriacao;
    }

    // Getters
    public function getId()          { return $this->id; }
    public function getCliente()     { return $this->cliente; }
    public function getEmail()       { return $this->email; }
    public function getTelefone()    { return $this->telefone; }
    public function getValor()       { return $this->valor; }
    public function getDescricao()   { return $this->descricao; }
    public function getStatus()      { return $this->status; }
    public function getDataCriacao() { return $this->dataCriacao; }

    // Setters
    public function setId($id)                { $this->id = $id; }
    public function setCliente($cliente)      { $this->cliente = $cliente; }
    public function setEmail($email)          { $this->email = $email; }
    public function setTelefone($telefone)    { $this->telefone = $telefone; }
    public function setValor($valor)          { $this->valor = $valor; }
    public function setDescricao($descricao)  { $this->descricao = $descricao; }
    public function setStatus($status)        { $this->status = $status; }
    public function setDataCriacao($dataCriacao) { $this->dataCriacao = $dataCriacao; }

    public function toArray() {
      return [
        'id' => $this->id,
        'cliente' => $this->cliente,
        'email' => $this->email,
        'telefone' => $this->telefone,
        'valor' => $this->valor,
        'descricao' => $this->descricao,
        'status' => $this->status,
        'dataCriacao' => $this->dataCriacao
      ];
    }
}
