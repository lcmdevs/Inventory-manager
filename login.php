<html>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="node_modules/bootstrap/compiler/bootstrap.css">
   <link rel="stylesheet" href="node_modules/bootstrap/compiler/style.css">
   <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css">

</head>
<div class="row">
   <div class="col-md-5 mx-auto">
      <div id="first">
         <div class="myform form ">
            <form action="" method="post" name="login" novalidate="novalidate">
               <div class="form-group">
                  <br><br>
                  <label for="exampleInputEmail1" class="col-md-12 text-center">
                     <h1>Laboratory Manager</h1>
                  </label>
                  <div class="logo mb-3">
                     <br>
                     <br>
                     <div class="col-md-12 text-center">
                        <h2>Login</h2>
                     </div>
                  </div><label for="exampleInputEmail1"></label>
               </div><input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
         </div>
         <div class="form-group">
            <div class="container">
            </div><label for="exampleInputEmail1"></label>
            <input type="password" name="senha" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
         </div>
         <div class="col-md-12 text-center ">
            <button type="submit" class=" btn btn-block mybtn btn-success tx-tfm">Login</button>
         </div>
         <br>
         <br>
      </div>
      </form>
   </div>
</div>
</div>
</div>
</div>
<?php
require_once 'classes/usuario.php';
$usuario = new usuario;
if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $senha = $_POST['senha'];
      //verificar se os campos estão todos preenchidos
      if (!empty($email) && !empty($senha)) {
            $usuario->conectar("lab", "localhost", "root", "");
            if ($usuario->msgErro == "") {
                  if ($usuario->logar($email, $senha)) {
                        header("location: index.php");
                     } else {
                        ?>
            <div class="alert alert-danger" role="alert">
               Email/senha inválidos .
            </div>
         <?php
      }
} else {
   ?>
         <div class="msn-erro">
            <?php
            echo "erro: " . $usuario->msgErro;
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
</body>

</html>