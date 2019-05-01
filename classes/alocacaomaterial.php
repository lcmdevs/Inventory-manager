<?php

 Class alocacao{

  private $pdo;
  public $msgErro="";

  public function conectar($dbname, $servidor, $usuario, $senha){
  global $pdo;
    try{
       $pdo = new PDO("mysql:dbname=".$dbname.";servidor=".$servidor, $usuario, $senha );
    }
    catch(PDOException $e){
    $e->getMessage();
    }

  }

  public function cadastrar($nome_material, $qtde, $localizacao){
    global $pdo;
    //verificar se o equipamento já está cadastrado
    $sql = $pdo->prepare("SELECT fk_material, fk_localizacao FROM alocacao WHERE fk_material = :material AND fk_localizacao = :localizacao");
    $sql->bindValue(":material",$nome_material);
    $sql->bindValue(":localizacao",$localizacao);

    $sql->execute();
    
      if($sql->rowCount($sql) > 0){

         //Somar quantidade.
        $sql =$pdo->prepare("UPDATE alocacao SET quantidade =  quantidade + :quantidade WHERE fk_material = :material AND fk_localizacao = :localizacao") ;
        $sql->bindValue(":quantidade",$qtde);
        $sql->bindValue(":material",$nome_material);
        $sql->bindValue(":localizacao",$localizacao);
        $sql->execute();

        return false;   // Já está cadastrado
      }
        else{ //caso não, cadastrar
        $sql = $pdo->prepare(" INSERT INTO alocacao(fk_material, fk_localizacao , quantidade) VALUES (:material, :localizacao, :quantidade)");
        $sql->bindValue(":material", $nome_material); 
        $sql->bindValue(":localizacao", $localizacao);  
        $sql->bindValue(":quantidade", $qtde);      
    
        $sql->execute();
        return true;
        }
    }
    
   }
   
?>