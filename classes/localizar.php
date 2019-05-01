<?php

 Class localizar{

  public $pdo;
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

  public function buscarMaterial($material){
    global $pdo;
    //verificar se está buscando material válido.
    $sql = $pdo->prepare("SELECT * FROM alocacao WHERE fk_material = :material");
    $sql->bindValue(":material",$material);

    $sql->execute();
    
      if($sql->rowCount($sql) > 0){

      return true;  
      }
       
    }
    
   }
   
?>