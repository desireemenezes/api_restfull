<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	/* ORGANIZANDO ARQUIVOS */
	//include_once('ProdutoController.php');
	include_once('Controller/ProdutoController.php');
	include_once('Controller/UsuarioController.php');
	include_once('Controller/ItemSacolaController.php');
	include_once('DAO/ProdutoDAO.php');
	include_once('DAO/UsuarioDAO.php');
	include_once('DAO/ItemSacolaDAO.php');
	include_once('Models/Produto.php');
	include_once('Models/Usuario.php');
	include_once('Models/ItemSacola.php');

	require './vendor/autoload.php';
	$app = new \Slim\App;

//cria um grupo para setar na url os metodos

$app->group('/produtos', function() use ($app) {	
	$app->get('','ProdutoController:listar');
	$app->post('','ProdutoController:inserir');
	$app->get('/{id}','ProdutoController:buscarPorId');    
	$app->put('/{id}','ProdutoController:atualizar');
	$app->delete('/{id}','ProdutoController:deletar');
});

/*->add('UsuarioController:validarToken');
	$app->post('/usuarios','UsuarioController:inserir');
	$app->get('/usuarios','UsuarioController:listar');
	$app->get('/usuarios/{id}','UsuarioController:buscarPorId');    
	$app->put('/usuarios/{id}','UsuarioController:atualizar');
	$app->delete('/usuarios/{id}', 'UsuarioController:deletar');
	//$app->get('/usuarios/{id}', 'UsuarioController:buscarPorLogin');
	//$app->get('/usuarios/{id}', 'UsuarioController:validarLogin');
	//$app->post('/auth','UsuarioController:autenticar');
	$app->post('/itemsacola','ItemSacolaController:inserir');
	$app->get('/itemsacola','ItemSacolaController:listar');
	$app->get('/itemsacola/{id}','ItemSacolaController:buscarPorId'); 
	$app->put('/itemsacola/{id}','ItemSacolaController:atualizar');
	$app->delete('/itemsacola/{id}', 'ItemSacolaController:deletar');
	*/
	
$app->run();
?>