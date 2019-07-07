<?php

include_once('Models/Produto.php');
include_once('DAO/ProdutoDAO.php');



class ProdutoController {
    

    //GET ALL Produtos
    public function listar($request, $response, $args) {
        $dao = new ProdutoDAO;    
        $produtos =  $dao->listar();
                
        $response = $response->withJson($produtos);
        $response = $response->withStatus(200);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;   
   
    }

    //"GET Produtos :id",
    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao = new ProdutoDAO;    
        $produto = $dao->buscarPorId($id);
        $response = $response->withJson($produto);
        $response = $response->withStatus(200);
        $response = $response->withHeader('Content-type', 'application/json');   
        
        return $response;
    }

    //POST Produtos
    public function inserir( $request, $response, $args) {
        $p = $request->getParsedBody();
        $produto = new Produto(0,$p['nome'],$p['descricao'],$p['preco']);
    
        $dao = new ProdutoDAO;
        $produto = $dao->inserir($produto);
    
        return $response->withJson($produto,201);    
    }
    
    
    //PUT Produtos :id
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $p = $request->getParsedBody();
        $produto = new Produto($id, $p['nome'], $p['descricao'],$p['preco']);
    
        $dao = new ProdutoDAO;
        $produto = $dao->atualizar($produto);
    
        return $response->withJson($produto);    
    }

    //DELETE Produtos :id
    public function deletar($request, $response, $args) {
        $id = $args['id'];

        $dao = new ProdutoDAO;
        $produto = $dao->deletar($id);
    
        $response = $response->withJson($produto);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;  
    }
}

?>