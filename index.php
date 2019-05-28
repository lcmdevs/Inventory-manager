<?php
session_start();
if( $_SESSION['matricula'] == null){
	header("location: login.php");
} else{


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Laboratory Manager</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
	<link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
	<link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css">
</head>
<body style="background-image:url(img/fundo.jpeg);">

	<?php
	$pagina = 'home';
	if (!empty($_GET['pagina'])) {
			$pagina = $_GET['pagina'];
		
		}
	if (file_exists("$pagina.php")) {
			# code...
			include("$pagina.php");
		} else {
			?> <i class="glyphicon glyphicon-thumbs-down"></i>Pagina não encotrada. <?php
			   }
	 																	
	  } ?> 
	<script src="https://code.jquery.com/jquery-3.1.1.min.js">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="node_modules/jquery/dist/jquery.js"></script>
	<script src="node_modules/Popper.js/dist/Popper.js"></script>
	<script src="script/validar.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>

	 <?php

	?>