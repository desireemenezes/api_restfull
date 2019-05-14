<?php
    include_once ('Produto.php');
    include_once ('Usuario.php');

    class Sacola {
        public $id;
        public $data_compra;
        public $cod_prod;
        public $cod_cli;
       
        function __construct($id, $data_compra, $cod_prod, $cod_cli){
            $this->id = $id;
            $this->data_compra = $data_compra;
            $this->cod_prod = $cod_prod;
            $this->cod_cli = $cod_cli;
          
            
        }
    }
?>