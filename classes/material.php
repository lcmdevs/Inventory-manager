<?php

 Class Material{

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
  public function cadastrar($nome, $descri, $tipo ){
  global $pdo;
  //verificar se o veiculo já está cadastrado
  $sql = $pdo->prepare("SELECT nome_modelo FROM material WHERE nome_modelo = :nome");
  $sql->bindValue(":nome",$nome);
  $sql->execute();

    if($sql->rowCount($sql) > 0){
    return false;   // Já está cadastrado
    }
      else{ //caso não, cadastrar
      $sql = $pdo->prepare(" INSERT INTO material(nome_modelo, descricao, fk_tipo ) VALUES (:nome_modelo, :descricao, :tipo)");
      $sql->bindValue(":nome_modelo", $nome); 
      $sql->bindValue(":descricao", $descri);  
      $sql->bindValue(":tipo", $tipo);      
  
      $sql->execute();
      return true;
      }
  }

  public function alterarMaterial($id, $nome, $descri, $tipo){
    global $pdo;
   
    $sql = $pdo->prepare("UPDATE material SET nome_modelo = :nome, descricao = :descri, fk_tipo = :tipo WHERE id = :id");
    $sql->bindValue(":nome",$nome);
    $sql->bindValue(":descri",$descri);
    $sql->bindValue(":tipo",$tipo);
    $sql->bindValue(":id",$id);
    $sql->execute();

    }
  }

    /*
    ---------------------------------------FUNÇAO EM PRODUÇÃO --------------------------------------
  public function buscarMaterial($material){
    global $pdo;
    //verificar se está buscando material válido.
    $sql = $pdo->prepare("SELECT fk_material, fk_localizacao, quantidade FROM alocacao WHERE fk_material = :material");
    $sql->bindValue(":material", $material);
    $sql->execute();

      if($sql->rowCount($sql) > 0){

          $dados = $sql->fetch();  
          $nomeMaterial = $dados['fk_material']; 
          $localizacoMaterial = $dados['fk_localizacao']; 
          $quantidadeMaterial = $dados['quantidade'] ;
      return true;  
      }


    }
*/
