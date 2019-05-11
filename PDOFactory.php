<?php
/* A CLASSE PDOfactory cria a conexao com o banco de dados */

    class PDOFactory {
    /* static cria somente uma conexão, declarando como privado e visivel apenas para classe
       acessando então com o metodo GET publico*/
       private static $pdo;

       public static function getConexao() {
           /* tentamos primeiro conectar, criamos a conexão PDO com a base de dados 
           isset retorna true caso a variavel tenha sido inicializada */
           try {

               if(!isset($pdo)) {
                    $pdo = new PDO('pgsql:host=localhost;dbname=brecho_01;user=postgres;password=postgresql');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                    $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
                    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                }
                
            return $pdo;

           } catch (PDOException $e) {
         
            // Mata o script
            die("Database connection failed: ". $e->getMessage() . "<br/>");
        }
            
    }
}
?>