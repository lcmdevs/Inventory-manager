<?php

 Class usuario{

  private $pdo;
  public $msgErro="";

  public function conectar($dbname, $servidor, $usuario, $senha){
  global $pdo;
    try{
       $pdo = new PDO("mysql:dbname=".$dbname.";servidor=".$servidor, $usuario, $senha);
    }
    catch(PDOException $e){
    $e->getMessage();
    }

  }
  
  /*public function cadastrar($email, $senha){
  global $pdo;
  //verificar se o e-mail já está cadastrado
  $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :email");
  $sql->bindValue(":email",$email);
  $sql->execute();

    if($sql->rowCount($sql) > 0){
    return false;   // Já está cadastrado
    }
      else{ //caso não, cadastrar
      $sql = $pdo->prepare(" INSERT INTO usuario(nome, telefone, cpf, numero, rua, bairro, cidade, estado, cep, complemento, email, senha, tipo) VALUES (:nome, :telefone, :cpf, :numero, :rua, :bairro, :cidade, :estado, :cep, :complemento, :email, :senha, :tipo)");
      $sql->bindValue(":nome", $nome);         
      $sql->bindValue(":telefone", $telefone);
      $sql->bindValue(":cpf", $cpf);
      $sql->bindValue(":numero", $numero);
      $sql->bindValue(":rua", $rua);
      $sql->bindValue(":bairro", $bairro);
      $sql->bindValue(":cidade", $cidade);
      $sql->bindValue(":estado", $estado);
      $sql->bindValue(":cep", $cep);
      $sql->bindValue(":complemento", $complemento);
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", $senha);  
      $sql->bindValue(":tipo", $tipo);  
      $sql->execute();
      return true;
      }
  }
  */
  public function logar($email, $senha){
  global $pdo;
  // Verificação
  $sql = $pdo->prepare("SELECT nome, matricula FROM usuario WHERE email = :email AND senha = :senha");
  $sql->bindValue(":email",$email);
  $sql->bindValue(":senha",$senha);
  $sql->execute();

   //se achar alguma matricula cadastrada então abre-se uma sessão pro usuário.
   if($sql->rowCount() > 0){
   //tranformar dados vindo do banco em array atarves da função fetch.
   $dado =  $sql->fetch();
  //startar a sessão 
  session_start();
  //pegar a matricula do usuario que está no banco e colocar dentro da sessão
  $_SESSION['matricula'] = $dado['matricula'];
  $_SESSION['nome'] = $dado['nome'];

  var_dump($dado['nome']);

  return true; //logado com sucesso.
   } 
     else{
     return false;

     }
  }
 }
?>
