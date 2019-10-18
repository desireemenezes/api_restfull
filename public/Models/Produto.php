<?php

class Produto {
    public $id;
    public $foto;
    public $nome;
    public $preco;
    public $descricao;

    /* 
        função construtora da classe produtos 
        passa no parametro os atributos da classe, o this acessa como pseudo variaveis

    */

    function __construct($id, $foto, $nome, $preco, $descricao) {
        $this->id = $id;
        $this->foto = $foto;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
    }

}

?>