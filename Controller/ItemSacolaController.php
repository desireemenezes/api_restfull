<?php
    include_once 'Models/ItemSacola.php';
    include_once 'DAO/ItemSacolaDAO.php';
    
    class ItemSacolaController{
        
        public function inserir($request, $response,$args){
            $var = $request->getParsedBody();
            $Sacola = new Sacola(0, $var['data_compra'], $var['cod_prod'],$var['cod_cli']);
        
            $dao = new ItemSacolaDAO;    
            $Sacola = $dao->inserir($Sacola);
        
            $response = $response->withJson($Sacola);
            $response = $response->withHeader('Content-type', 'application/json');    
            $response = $response->withStatus(201);
            
            return $response;
        }

        public function listar($request, $response,$args){
            $dao = new ItemSacolaDAO;    
            $Sacola  = $dao->listar();        
            
            $response = $response->withJson($Sacola );
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }

        public function buscarPorId($request, $response,$args){
            $id = $args['id'];
            
                $dao = new itemSacolaDAO;    
                $Sacola = $dao->buscarPorId($id);  
                
                $response = $response->withJson($Sacola);
                $response = $response->withHeader('Content-type', 'application/json');    
                return $response;
        }

        public function atualizar($request, $response,$args){
            $id = $args['id'];
            $var = $request->getParsedBody();
            $sacola = new Sacola($id, $var['data_compra'] ,$var['cod_prod'], $var['cod_cli']);
        
            $dao = new itemSacolaDAO;    
            $dao->atualizar($sacola);
        
            $response = $response->withJson($sacola);
            $response = $response->withHeader('Content-type', 'application/json');    
            return $response;
        }
        public function deletar($request, $response,$args){
            $id = $args['id'];
            
                $dao = new itemSacolaDAO; 
                $sacola = $dao->buscarPorId($id);   
                $dao->deletar($id);
            
                $response = $response->withJson($sacola);
                $response = $response->withHeader('Content-type', 'application/json');    
                return $response;
            
            
        }
    }
?>