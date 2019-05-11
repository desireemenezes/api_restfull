<?php
    use \Firebase\JWT\JWT;
    
    include_once('Models/Usuario.php');
    include_once('DAO/UsuarioDAO.php');

    class UsuarioController{
        private $secretKey = "1234";

        public function inserir($request, $response, $args)
        {
            $var = $request->getParsedBody();
            $usuario = new Usuario(0, $var['nome'], $var['login'], $var['senha']);
        
            $dao = new UsuarioDAO;    
            $usuario = $dao->inserir($usuario);
        
            return $response->withJson($usuario,201);
        }

        public function autenticar($request, $response, $args)
        {
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