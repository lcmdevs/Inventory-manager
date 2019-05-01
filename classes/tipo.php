<?php
Class tipo{

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

      public function buscar($tipo){
      global $pdo;

      }
  
    }