<?php 
     session_start();
	 require_once 'conexao.php';
     $conn = new Conexao;
     $conn->conectar();

    global $pdo;

    $id = $_GET['id'];

    if(!empty($id)){
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

    if($material != null ){

		$_SESSION['msg'] = " <div class='alert alert-success'  style='margin-top: 10px; margin-bottom:-60px;' role='alert'> Material excluido com sucesso </div>";
		header('location:index.php?pagina=home&action=editar');
	}else{
		
		$_SESSION['msg'] = " <div class='alert alert-danger'  style='margin-top: 10px; margin-bottom:-60px;' role='alert'> Falha ao apagar material </div>";
		header('location:index.php?pagina=home&action=editar');
	}
    
    }