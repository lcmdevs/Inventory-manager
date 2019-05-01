<?php 
	 require_once 'sql.php';
     $sql = new Sql;
     $sql->conectar("lab", "localhost", "root", "");
    
    global $pdo;

    $id = $_GET['id'];
    $buscar = $pdo->prepare("SELECT nome_modelo FROM material WHERE id=:id");
    $buscar->bindValue(":id",$id);
    $buscar->execute();
    $dados = $buscar->fetch();
    $material = $dados['nome_modelo'];

	$deletar = $pdo->prepare("DELETE FROM alocacao WHERE fk_material=:material");
	$deletar->bindValue(":material",$material);
    $deletar->execute();

    $deletar = $pdo->prepare("DELETE FROM material WHERE id=:id");
	$deletar->bindValue(":id",$id);
    $deletar->execute();

    //$apagado = true;

	header('location:index.php?pagina=home&action=geral');
