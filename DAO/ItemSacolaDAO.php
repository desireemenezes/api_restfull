<?php
    include_once 'Models/ItemSacola.php';
    include_once 'PDOFactory.php';
    
    class ItemSacolaDAO
    
    {
        public function inserir(Sacola $Sacola) {

            $qInserir = "INSERT INTO itemsacola(data_compra,cod_prod,cod_cli) VALUES (:data_compra,:cod_prod,:cod_cli)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":data_compra",$Sacola->data_compra);
            $comando->bindParam(":cod_prod",$Sacola->cod_prod);
            $comando->bindParam(":cod_cli",$Sacola->cod_cli);
            $comando->execute();
            $Sacola->id = $pdo->lastInsertId();
            return $Sacola;
        }

        public function listar() {
		    $query = 'SELECT * FROM itemsacola inner join produto on(itemsacola.cod_prod = produto.id) inner join usuario on(itemsacola.cod_cli = usuario.id)';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $Sacola=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $Sacola[] = new Sacola($row->id,$row->data_compra,$row->cod_prod,$row->cod_cli);
            }
            return $Sacola;
        }

        public function buscarPorId($id) {
 		    $query = 'SELECT * FROM itemsacola inner join produto on(itemsacola.cod_prod = produto.id) inner join usuario on(itemsacola.cod_cli = usuario.id) WHERE itemsacola.id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Sacola($result->id,$result->cod_prod,$result->cod_prod,$result->cod_cli);           
        }
        
        public function deletar($id) {
            $qDeletar = "DELETE from itemsacola WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }
        public function atualizar(Sacola $Sacola) {
            $qAtualizar = "UPDATE itemsacola SET cod_cli=:cod_cli, cod_prod=:cod_prod, data_compra=:data_compra WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":id",$Sacola->id);
            $comando->bindParam(":data_compra",$Sacola->data_compra);
            $comando->bindParam(":cod_prod",$Sacola->cod_prod);
            $comando->bindParam(":cod_cli",$Sacola->cod_cli);
     
            $comando->execute();        
        }
 
    }


?>