<?php

namespace app\models;

class Servico {
    private $id;
    private $nome;
    private $categoria;
    private $preco;
    private $duracao;
    private $descricao;

    public function __construct($id = null, $nome = null, $categoria = null, $preco = null, $duracao = null, $descricao = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->preco = $preco;
        $this->duracao = $duracao;
        $this->descricao = $descricao;
    }

    // Getters
    public function getId()        { return $this->id; }
    public function getNome()      { return $this->nome; }
    public function getCategoria() { return $this->categoria; }
    public function getPreco()     { return $this->preco; }
    public function getDuracao()   { return $this->duracao; }
    public function getDescricao() { return $this->descricao; }

    // Setters
    public function setId($id)                { $this->id = $id; }
    public function setNome($nome)            { $this->nome = $nome; }
    public function setCategoria($categoria)  { $this->categoria = $categoria; }
    public function setPreco($preco)          { $this->preco = $preco; }
    public function setDuracao($duracao)      { $this->duracao = $duracao; }
    public function setDescricao($descricao)  { $this->descricao = $descricao; }

    public function toArray() {
      return [
        'id' => $this->id,
        'nome' => $this->nome,
        'categoria' => $this->categoria,
        'preco' => $this->preco,
        'duracao' => $this->duracao,
        'descricao' => $this->descricao
      ];
    }
}
