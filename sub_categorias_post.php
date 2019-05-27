<?php include_once("conexao.php");

	$id_categoria = $_REQUEST['idEquipamento'];

	$result_sub_cat = "SELECT * FROM equipamento WHERE nome_modelo ='$id_categoria' AND situacao = 'Disponivel'";
	$resultado_sub_cat = mysqli_query($conn, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$sub_categorias_post[] = array(
			'id'	=> $row_sub_cat['id'],
			'codigo' => utf8_encode($row_sub_cat['codigo']),
		);
	}
	
	echo(json_encode($sub_categorias_post));
