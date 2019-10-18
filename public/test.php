<?php
	    include_once('Models/Produto.php');
	    include_once('DAO/ProdutoDAO.php');

	    $produto = new Produto(0, "tenis", 287.50, "Usado. Bom estado");
	   	
	    $dao= new ProdutoDAO;    
	    $produto = $dao->inserir($produto);

	    $produto = $dao->buscarPorId(4);
	    $produto = new Produto(4, "cama solteiro", 227.50, "Nova");
	    $dao->atualizar($produto);

	    $dao->deletar(5);				


	    $produtos =  $dao->listar();	
	    print_r($produtos);
	?>