<?php

 Class Equipamento{

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
  public function cadastrar($nome, $codigo, $status){
  global $pdo;
  //verificar se o equipamento já está cadastrado
  $sql = $pdo->prepare("SELECT codigo FROM equipamento WHERE codigo = :codigo");
  $sql->bindValue(":codigo",$codigo);
  $sql->execute();

    if($sql->rowCount($sql) > 0){
    return false;   // Já está cadastrado
    }
      else{ //caso não, cadastrar
      $sql = $pdo->prepare(" INSERT INTO equipamento(nome_modelo, codigo, situacao) VALUES (:nome_modelo, :codigo, :situacao)");
      $sql->bindValue(":nome_modelo", $nome); 
      $sql->bindValue(":codigo", $codigo);  
      $sql->bindValue(":situacao", $status);      
  
      $sql->execute();
      return true;
      }
  }

  public function realizarEmprestimo($equipamento, $service, $usuario, $email, $dataInicio, $dataFim){
  global $pdo;

  $sql = $pdo->prepare("INSERT INTO emprestimo(nome_modelo, fk_codigo, usuario, email, data_inicio, data_fim,
  prazo_emprestimo ) VALUES(:equipamento, :serviceTag, :usuario, :email, :dataInicio, :dataFim, :prazo)");
  $sql->bindValue(":equipamento", $equipamento); 
  $sql->bindValue(":serviceTag", $service);  
  $sql->bindValue(":usuario", $usuario); 
  $sql->bindValue(":email", $email); 
  $sql->bindValue(":dataInicio", $dataInicio);  
  $sql->bindValue(":dataFim", $dataFim);
  $sql->bindValue(":prazo",'Dentro do prazo'); 
  $sql->execute();

  $sql = $pdo->prepare("UPDATE equipamento SET situacao = :situacao WHERE nome_modelo = :equipamento AND codigo = :serviceTag");
  $sql->bindValue(":equipamento", $equipamento); 
  $sql->bindValue(":situacao", 'Indisponivel');
  $sql->bindValue(":serviceTag", $service); 
  $sql->execute();

 
  return true;

  }
  
  public function realizarDevolucao($service, $dataDevolucao){
  global $pdo;

  $sql = $pdo->prepare("UPDATE equipamento SET situacao = :situacao WHERE codigo = :serviceTag");
 
  $sql->bindValue(":situacao", 'Disponivel');
  $sql->bindValue(":serviceTag", $service); 
  $sql->execute();

  $sql = $pdo->prepare("SELECT * FROM emprestimo WHERE fk_codigo = :serviceTag");
  $sql->bindValue(":serviceTag", $service); 
  $sql->execute();

  $registro = $sql->fetch(); 

  $dataFim = $registro['data_fim'];

  //Dentro do prazo
  if($dataFim >= $dataDevolucao){
    $sql = $pdo->prepare("UPDATE emprestimo SET prazo_emprestimo = :situacao WHERE fk_codigo = :serviceTag");
    $sql->bindValue(":situacao", 'Finalizado dentro do prazo');
    $sql->bindValue(":serviceTag", $service); 
    $sql->execute();

  }
  else {
    $sql = $pdo->prepare("UPDATE emprestimo SET prazo_emprestimo = :situacao WHERE fk_codigo = :serviceTag");
    $sql->bindValue(":situacao", 'Finalizado fora do prazo');
    $sql->bindValue(":serviceTag", $service); 
    $sql->execute();
   

  }

  return true;
  } 
}
?>