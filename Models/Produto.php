<?php

class Produto {
    public $id;
    public $nome;
    public $preco;
    public $descricao;

    /* 
        função construtora da classe produtos 
        passa no parametro os atributos da classe, o this acessa como pseudo variaveis

    */

    function __construct($id, $nome, $preco, $descricao) {

        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
    }

}

?>