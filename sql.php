<?php

 class Sql{

    private $pdo;
    public $msgErro="";

    public function conectar(){
    global $pdo;
        $dbname="lab";
        $servidor="localhost";
        $usuario="root";
        $senha="";
      try{
         $pdo = new PDO("mysql:dbname=".$dbname.";servidor=".$servidor, $usuario, $senha );
      }
      catch(PDOException $e){
      $e->getMessage();
      }
  
    }
    public function retirarMaterial($material, $quantidade, $localizacao){
         global $pdo;
         //verificar se a quantidade a ser retirada é menor ou igual ao valor cadastrado.
         $sql = $pdo->prepare("SELECT * FROM alocacao WHERE fk_material = :material
                               AND fk_localizacao = :localizacao");
         $sql->bindValue(":material",$material);
         $sql->bindValue(":localizacao",$localizacao);
         $sql->execute();
         $dados = $sql->fetch();
      
         // Se o valor alocado for maior ou igual
         if($dados['quantidade'] >= $quantidade)
         {

         //Subtrair quantidade.
         $sql =$pdo->prepare("UPDATE alocacao SET quantidade =  quantidade - :quantidade 
                              WHERE fk_material = :material AND fk_localizacao = :localizacao") ;
         $sql->bindValue(":quantidade",$quantidade);
         $sql->bindValue(":material",$material);
         $sql->bindValue(":localizacao",$localizacao);
         $sql->execute();
           
         $sql = $pdo->prepare("DELETE FROM Alocacao WHERE quantidade = 0");
         $sql->execute();
         
         return true;
             
         } else{
         return false;
         }
      }
   }