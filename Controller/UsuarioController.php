<?php
    use \Firebase\JWT\JWT;
    
    include_once('Models/Usuario.php');
    include_once('DAO/UsuarioDAO.php');

    class UsuarioController{
        private $secretKey = "123";

        public function inserir($request, $response, $args) {
            $var = $request->getParsedBody();
            $usuario = new Usuario(0, $var['nome'], $var['login'], $var['senha']);
        
            $dao = new UsuarioDAO;    
            $usuario = $dao->inserir($usuario);
        
            return $response->withJson($usuario,201);
        }

        public function listar($request, $response, $args) {
            $dao = new UsuarioDAO;    
            $usuario =  $dao->listar();
                    
            $response = $response->withJson($usuario);
            $response = $response->withStatus(200);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;   
       
        }

        public function buscarPorId($request, $response, $args) {
            $id = $args['id'];
            
            $dao = new UsuarioDAO;    
            $usuario = $dao->buscarPorId($id);
            $response = $response->withJson($usuario);
            $response = $response->withStatus(200);
            $response = $response->withHeader('Content-type', 'application/json');   
            
            return $response;
        }

        public function deletar($request, $response, $args) {
            $id = $args['id'];
    
            $dao = new UsuarioDAO;
            $usuario = $dao->deletar($id);
        
            $response = $response->withJson($usuario);
            $response = $response->withHeader('Content-type', 'application/json');
            return $response;  
        }

        public function atualizar($request, $response, $args) {
            $id = $args['id'];
            $var = $request->getParsedBody();
            $usuario = new Usuario(0, $var['nome'], $var['login'], $var['senha']);
        
            $dao = new UsuarioDAO;
            $produto = $dao->atualizar($usuario);
        
            return $response->withJson($usuario);    
        }
    

        public function autenticar($request, $response, $args) {
            $user = $request->getParsedBody();
            
            $dao= new UsuarioDAO;    
            $usuario = $dao->buscarPorLogin($user['login']);
            if($usuario->senha == $user['senha'])
            {
                $token = array(
                    'user' => strval($usuario->id),
                    'nome' => $usuario->nome
                );
                $jwt = JWT::encode($token, $this->secretKey);
                return $response->withJson(["token" => $jwt], 201)
                    ->withHeader('Content-type', 'application/json');   
            }
            else
                return $response->withStatus(401);
        }

        public function validarToken($request, $response, $next)
        {
            $token = $request->getHeader('Authorization')[0];
            
            if($token)
            {
                try {
                    $decoded = JWT::decode($token, $this->secretKey, array('HS256'));

                    if($decoded)
                        return($next($request, $response));
                } catch(Exception $error) {

                    return $response->withStatus(401);
                }
            }
            
            return $response->withStatus(401);
        }
    }

?>