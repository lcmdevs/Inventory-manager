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
    public function buscarMaterial($nomeMaterial){
    global $pdo;

    //verificar se está buscando material válido.
    $sql = $pdo->prepare("SELECT * FROM alocacao WHERE fk_material = :material");
    $sql->bindValue(":material",$nomeMaterial);

    $sql->execute();
    
      if($sql->rowCount($sql) > 0){

      return true;  
      }

      else {
        return false;
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

      public function localizar(){

        	//Incluir a conexão com banco de dados
          include_once('../conexao.php');
          
          //Recuperar o valor da palavra
          $material = $_POST['palavra'];
          
          //Pesquisar no banco de dados nome do curso referente a palavra digitada pelo usuário
          $sql = "SELECT * FROM alocacao WHERE nome_modelo LIKE '%$material%'";
          $resultado_cursos = mysqli_query($conn, $sql);
          
          if(mysqli_num_rows($resultado_cursos) <= 0){
            echo "Nenhum curso encontrado...";
          }else{
            while($rows = mysqli_fetch_assoc($resultado_cursos)){
              echo "<li>".$rows['nome']."</li>";
            }
          }

      }
   
  }
  