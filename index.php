<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	/* ORGANIZANDO ARQUIVOS */
	//include_once('ProdutoController.php');
	include_once('Controller/ProdutoController.php');
	include_once('DAO/ProdutoDAO.php');
	include_once('Models/Produto.php');

	require './vendor/autoload.php';
	$app = new \Slim\App;

	//cria um grupo para setar na url os metodos
	$app->group('/produtos', function() use ($app) {
		$app->get('','ProdutoController:listar');
		$app->post('','ProdutoController:inserir');
	
		$app->get('/{id}','ProdutoController:buscarPorId');    
		$app->put('/{id}','ProdutoController:atualizar');
		$app->delete('/{id}', 'ProdutoController:deletar');
	});
	
	$app->run();
