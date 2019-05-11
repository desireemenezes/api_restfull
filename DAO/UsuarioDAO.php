<?php

    include_once 'Models/Usuario.php';
    include_once 'PDOFactory.php';

    class UsuarioDAO
    {
        public function inserir(Usuario $usuario)
        {
            $qInserir = "INSERT INTO usuario(nome,login,senha) VALUES (:nome,:login,:senha)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":login",$usuario->login);
            $comando->bindParam(":senha",$usuario->senha);
            $comando->execute();
            $usuario->id = $pdo->lastInsertId();
            return $usuario;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from usuario WHERE id=:id";            
            $usuario = $this->buscarPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $usuario;
        }

        public function atualizar(Usuario $usuario)
        {
            $qAtualizar = "UPDATE usuario SET nome=:nome, login=:login, senha=:senha WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$usuario->nome);
            $comando->bindParam(":login",$usuario->login);
            $comando->bindParam(":senha",$usuario->senha);
            $comando->bindParam(":id",$usuario->id);
            $comando->execute();
            return $usuario;        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM usuario';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $usuarios=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $usuarios[] = new Usuario($row->id,$row->nome,$row->login,$row->senha);
            }
            return $usuarios;
        }

        public function buscarPorId($id) {
 		    $query = 'SELECT * FROM usuario WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario($result->id,$result->nome,$result->login,$result->senha);           
        }

        public function buscarPorLogin($login) {
 		    $query = 'SELECT * FROM usuario WHERE login=:login';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('login', $login);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Usuario($result->id,$result->nome,$result->login,$result->senha);           
        }
    }
?>