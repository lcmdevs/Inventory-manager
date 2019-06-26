<?php

    session_start();
    require_once 'classes/material.php';
    require_once 'conexao.php';

    $conn = new Conexao;
    $material = new material;

    if (isset($_POST['nome'])) {
      $nome = $_POST['nome'];
      $descri = $_POST['descri'];
      $tipo = $_POST['tipo'];
      $id = $_POST['id'];
      //verificar se os campos estão todos preenchidos
      if (!empty($nome) && !empty($tipo)) {

        $conn->conectar();

        if ($conn->msgErro == "") {
            
          $material->alterarMaterial($id, $nome, $descri, $tipo);

          $_SESSION['msg'] = " <div class='alert alert-success' role='alert'> Material alterado com sucesso </div>";
          header('location:index.php?pagina=home&action=editar');
        } else {

         	$_SESSION['msg'] = " <div class='alert alert-danger' role='alert'> Não foi possivel alterar </div>";
		header('location:index.php?pagina=home&action=editar');
        }

      } else {

        $_SESSION['msg'] = " <div class='alert alert-danger' role='alert'> Preencha todos os campos </div>";
		header('location:index.php?pagina=home&action=editar');
      }
    }