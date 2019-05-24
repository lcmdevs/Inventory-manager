<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "lab";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);


 class Conexao{

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
}