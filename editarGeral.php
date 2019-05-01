<?php 
	/* require_once 'sql.php';
     $sql = new Sql;
     $sql->conectar();
    
    global $pdo;

    $id = $_GET['id'];
    $buscar = $pdo->prepare("SELECT nome_modelo, descricao, tipo FROM material WHERE id=:id");
    $buscar->bindValue(":id",$id);
    $buscar->execute();
    $dados = $buscar->fetch();
    $material = $dados['nome_modelo'];
    $material = $dados['nome_modelo'];
    $material = $dados['nome_modelo'];

	$deletar = $pdo->prepare("DELETE FROM alocacao WHERE fk_material=:material");
	$deletar->bindValue(":material",$material);
    $deletar->execute();

    $deletar = $pdo->prepare("DELETE FROM material WHERE id=:id");
	$deletar->bindValue(":id",$id);
    $deletar->execute();

    //$apagado = true;

	header('location:index.php?pagina=home&action=geral'); */

    require_once 'classes/material.php';
    $material = new material;
    if (isset($_POST['nome'])) {
      $nome = $_POST['nome'];
      $descri = $_POST['descri'];
      $tipo = $_POST['tipo'];
      $id = $_POST['id'];
      //verificar se os campos estão todos preenchidos
      if (!empty($nome) && !empty($tipo)) {
        $material->conectar("lab", "localhost", "root", "");
        if ($material->msgErro == "") {
             $material->alterarMaterial($id, $nome, $descri, $tipo);
            ?>
            <div class="alert alert-success" role="alert">
              Material cadastrado.
            </div> 
          <?php
         } 
         else {
        ?>
          <div class="msn-erro">
            <?php
            echo "erro: " . $material->msgErro;
            ?>
          </div>
        <?php
      }
    } else {
      ?>
        <div class="alert alert-danger" role="alert">
          Preencha todos os campos.
        </div>
      <?php
    }
  }
  ?>