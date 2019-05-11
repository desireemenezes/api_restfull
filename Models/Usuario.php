<?php
    class Usuario {
        public $id;
        public $nome;
        public $login;
        public $senha;

        function __construct($id, $nome, $login, $senha){
            $this->id = $id;
            $this->nome = $nome;
            $this->login = $login;
            $this->senha = $senha;
        }
    }
?>