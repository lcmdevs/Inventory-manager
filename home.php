<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand h1 mb-0" href="index.php">Laboratory Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSite">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="navDrop">
            Armário
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=home&action=material" role="button">Cadastro de Material</a>
            <a class="dropdown-item" href="?pagina=home&action=alocacao" role="button">Alocação de Material</a>
            <a class="dropdown-item" href="?pagina=home&action=armario" role="button">Exibir Armários</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="navDrop">
            Estoque
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=home&action=hardware" role="button">Hardware</a>
            <a class="dropdown-item" href="?pagina=home&action=telefonia" role="button">Telefonia</a>
            <a class="dropdown-item" href="?pagina=home&action=impressao" role="button">Impressão</a>
            <a class="dropdown-item" href="?pagina=home&action=geral" role="button">Geral</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="navDrop">
            Empréstimo
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=home&action=equipamento" role="button">Cadastro de Equipamento</a>
            <a class="dropdown-item" href="?pagina=home&action=statusequipamento" role="button">Status Equipamento</a>
            <a class="dropdown-item" href="?pagina=home&action=emprestimo" role="button">Novo Empréstimo</a>
            <a class="dropdown-item" href="?pagina=home&action=devolucao" role="button">Devolução de Empréstimo</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sair.php">
            Sair
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="margin-left:310px; color:white;" href=""> Seja Bem vindo <?php echo $_SESSION['nome']; ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br />

<?php
$action = '';
//$cor = 'yellow';
//$gavetasCor = ['Bau A' => 'Bau A', 'Bau B' => 'Bau B', 'Bau C' => 'Bau C', 'Gaveta B.1' => 'Gaveta B.1'];

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}
if ($action == 'armario') {
  
                require_once 'classes/localizar.php';
                $localizar = new localizar;
                if (isset($_POST['material'])) {
                  $material = $_POST['material'];
                  //verificar se os campos estão todos preenchidos
                  if (!empty($material)) {
                    $localizar->conectar();
                    if ($localizar->msgErro == "") {
                      if ($localizar->buscarMaterial($material) == true) {
                        $sql = $pdo->prepare("SELECT fk_material, fk_localizacao, quantidade FROM alocacao WHERE fk_material LIKE :material");
                        $sql->bindValue(":material", $material."%");
                        $sql->execute();
                        echo '<table  class="table table-hover">';
                        echo '<tr>';
                        echo '<td><b>Nome_modelo</td>';
                        echo '<td><b>Localização</td>';
                        echo '<td><b>Quantidade</td>';
                        echo '</tr>';
                        while ($dados = $sql->fetch()) {
                          echo '<tr>';
                          echo '<td>' . $dados['fk_material'] . '</td>';
                          echo '<td>' . $dados['fk_localizacao'] . '</td>';
                          echo '<td>' . $dados['quantidade'] . '</td>';
                          echo '</tr>';

                          ######################################################################################################################     
                          //if (trim($dados['fk_localizacao']) == $gavetasCor[trim($dados['fk_localizacao'])]) {

                            //$gavetasCor[trim($dados['fk_localizacao'])]  = 'red';
                         // }
                          ######################################################################################################################                        
                        }
                        echo '</table>';
                      } else {
                        ?>
                        <div class="alert alert-danger" role="alert">
                          Este material não está alocado.
                        </div>
                      <?php
                    }
                  } else {
                    ?>
                      <div class="msn-erro">
                        <?php
                        echo "erro: " . $equipamento->msgErro;
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
              <br>
              
  <div class="row">
    <div class="col-md-12">
      <div class="card card-body">
        <div class="table-responsive col-md-12">
          <div id="main" class="container">
            </a>
            <nav class="navbar navbar-light bg-light">
              <form class="form-inline ml-auto" method="POST" style="width: 100%;">
                <input type="text" name="material" class="form-control" placeholder="Localizar">

              
                <input type="image" src="img/lupa.png" alt="submit" /></a>
              </form>
            </nav>
            <div class="row">
              <div class="col bg-gradient-secondary" style="color:#28a745; height:700px; border: 1px solid;">A
                <div class="col-12 bg-gradient-light" style="height: 110px; border:1px solid;">
                  <a class="btn btn-sucess btn-block my-4" href="#" class="col-sm-11 testes2 bg-gradient-light" data-toggle="modal" data-target="#siteModal1" style="color:#28a745;padding-top:4%;">Bau A</a>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" class="col-sm-5 testes3 bg-gradient-light" data-toggle="modal" data-target="#siteModal2" style="color:#28a745;padding-top:10%">Prateleira A.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal3" style="color:#28a745;padding-top:10%">Prateleira A.2</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal4" style="color:#28a745;padding-top:1%">Gaveta A.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal5" style="color:#28a745;padding-top:1%">Gaveta A.4</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal6" style="color:#28a745;padding-top:1%">Gaveta A.2</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal7" style="color:#28a745;padding-top:1%">Gaveta A.5</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal8" style="color:#28a745;padding-top:1%">Gaveta A.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal9" style="color:#28a745;padding-top:1%">Gaveta A.6</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal10" style="color:#28a745;padding-top:8%">Prateleira A.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal11" style="color:#28a745;padding-top:8%">Prateleira A.4</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Div testes1 -->
              <div class="col bg-gradient-secondary" style="height: 700px; border: 1px solid; color:#28a745">B
                <div class="container">
                  <div class="row">
                    <div class="col-12 bg-gradient-light" style="height: 110px; border:1px solid;">
                      <a class="btn btn-sucess btn-block my-4" href="#" data-toggle="modal" data-target="#siteModal12" style="color:#28a745;padding-top:4%;">Bau B</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal13" style="color:#28a745;padding-top:10%">Prateleira B.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal14" style="color:#28a745;padding-top:10%">Prateleira B.2</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal15" style="color:#28a745;padding-top:1%;">Gaveta B.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal16" style="color:#28a745;padding-top:1%">Gaveta B.4</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal17" style="color:#28a745;padding-top:1%">Gaveta B.2</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal18" style="color:#28a745;padding-top:1%">Gaveta B.5</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal19" style="color:#28a745;padding-top:1%">Gaveta B.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal20" style="color:#28a745;padding-top:1%">Gaveta B.6</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal21" style="color:#28a745;padding-top:8%">Prateleira B.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal22" style="color:#28a745;padding-top:8%">Prateleira B.4</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- DIV testes1 -->
              <div class="col-sm-4 bg-gradient-secondary" style="height: 700px; border:1px solid; color:#28a745">C
                <div class="container">
                  <div class="row">
                    <div class="col-12 bg-gradient-light" style="height: 110px; border:1px solid;">
                      <a class="btn btn-sucess btn-block my-4" href="#" data-toggle="modal" data-target="#siteModal23" style="color:#28a745;padding-top:4%;">Bau C</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal24" style="color:#28a745;padding-top:10%">Prateleira C.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal25" style="color:#28a745;padding-top:10%">Prateleira C.2</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal26" style="color:#28a745;padding-top:1%">Gaveta C.1</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal27" style="color:#28a745;padding-top:1%">Gaveta C.4</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal28" style="color:#28a745;padding-top:1%">Gaveta C.2</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal29" style="color:#28a745;padding-top:1%">Gaveta C.5</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal30" style="color:#28a745;padding-top:1%">Gaveta C.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 60px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal31" style="color:#28a745;padding-top:1%">Gaveta C.6</a>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container">
                  <div class="row">
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal32" style="color:#28a745;padding-top:8%">Prateleira C.3</a>
                    </div>
                    <div class="col-6 bg-gradient-light" style="height: 110px; border: 1px solid;">
                      <a class="btn btn-block btn-sucess my-4" href="#" data-toggle="modal" data-target="#siteModal33" style="color:#28a745;padding-top:8%">Prateleira C.4</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <!-- Modais -->
  <!-- Modal Bau A -->
  <?php
        require_once 'sql.php';
        $sql = new Sql;

        if (isset($_POST['materialBauA'])) {
          $material = $_POST['materialBauA'];
          $quantidade = $_POST['quantidade'];
          $localizacao = 'Bau A';
          //verificar se os campos estão todos preenchidos
          if (!empty($material) && !empty($quantidade)) {
            $sql->conectar("lab", "localhost", "root", "");
            if ($sql->msgErro == "") {
              if ($sql->retirarMaterial($material, $quantidade, $localizacao) == true) {
                ?>
                <div style="bottom:838px; " class="alert alert-success" role="alert">
                  Material retirado.
                </div>
              <?php
            } else {
              ?>
                <div style="bottom:838px;"  class="alert alert-danger" role="alert">
                  Você não pode retirar mais do que tem.
                </div>
              <?php
            }
          } else {
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
            <div  style="bottom:838px;" class="alert alert-danger" role="alert">
              Preencha todos os campos.
            </div>
          <?php
        }
      }
      ?>
    <div class="modal fade" id="siteModal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Bau A</h3>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau A'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauA">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->

                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialbauA'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Bau A'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira A.1 -->
  <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraA1'])) {
              $material = $_POST['materialPraA1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira A.1';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px; " class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px; "class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px; " class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>
            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->

                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialPraA1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>

                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira A.2 -->
  <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraA2'])) {
              $material = $_POST['materialPraA2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira A.2';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px;"class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px;" class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px;" class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>
            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA2">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialPraA2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>

                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.1 -->
  <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA1'])) {
              $material = $_POST['materialGavetaA1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.1';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px;" class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px;" class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px;" class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal4" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>

            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA1">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialGavetaA1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.4 -->
  <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA4'])) {
              $material = $_POST['materialGavetaA4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.4';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px;" class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px;" class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px;" class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal5" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.4</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>

            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA4">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialGaveta4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>

                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.2 -->
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA2'])) {
              $material = $_POST['materialGavetaA2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.2';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px;" class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px;" class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px;" class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal6" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>
            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA2">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialGavetaA2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>

                  <?php
                }
                mysqli_close($conn);

                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.5 -->
  <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA5'])) {
              $material = $_POST['materialGavetaA5'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.5';


              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div style="bottom:838px;" class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div style="bottom:838px;" class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
                <div style="bottom:838px;" class="alert alert-danger" role="alert">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }
          ?>
  <div class="modal fade" id="siteModal7" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.5</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>
            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.5'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA5">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">

                  <?php
                  $material = $_POST['materialGavetaA5'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.5'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.3 -->
  <div class="modal fade" id="siteModal8" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->

                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA3'])) {
              $material = $_POST['materialGavetaA3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta A.6 -->
  <div class="modal fade" id="siteModal9" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.6</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.6'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA6'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta A.6'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaA6'])) {
              $material = $_POST['materialGavetaA6'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta A.6';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira A.3 -->
  <div class="modal fade" id="siteModal10" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php

                  $material = $_POST['materialPraA3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");

                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraA3'])) {
              $material = $_POST['materialPraA3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira A.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira A.4 -->
  <div class="modal fade" id="siteModal11" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.4</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraA4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");

                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraA4'])) {
              $material = $_POST['materialPraA4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira A.4';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Bau B -->
  <div class="modal fade" id="siteModal12" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bau B</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau B'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauB">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialBauB'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Bau B'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialBauB'])) {
              $material = $_POST['materialBauB'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Bau B';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira B.1 -->
  <div class="modal fade" id="siteModal13" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira B.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraB1'])) {
              $material = $_POST['materialPraB1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira B.1';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira B.2 -->
  <div class="modal fade" id="siteModal14" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira B.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">

            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraB2'])) {
              $material = $_POST['materialPraB2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira B.2';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.1 -->
  <div class="modal fade" id="siteModal15" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);

                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB1'])) {
              $material = $_POST['materialGavetaB1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.1';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.4 -->
  <div class="modal fade" id="siteModal16" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.4</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>

            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB4'])) {
              $material = $_POST['materialGavetaB4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.4';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.2 -->
  <div class="modal fade" id="siteModal17" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>

            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");

                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB2'])) {
              $material = $_POST['materialGavetaB2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.2';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.5 -->
  <div class="modal fade" id="siteModal18" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.5</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.5'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>

            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB5">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB5'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.5'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB5'])) {
              $material = $_POST['materialGavetaB5'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.5';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.3 -->
  <div class="modal fade" id="siteModal19" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");

                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB3'])) {
              $material = $_POST['materialGavetaB3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta B.6 -->
  <div class="modal fade" id="siteModal20" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.6</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);


            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.6'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB6'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta B.6'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">

            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaB6'])) {
              $material = $_POST['materialGavetaB6'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta B.6';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira B.3 -->
  <div class="modal fade" id="siteModal21" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira B.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraB3'])) {
              $material = $_POST['materialPraB3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira B.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira B.4 -->
  <div class="modal fade" id="siteModal22" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.4</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira B.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">

            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraB4'])) {
              $material = $_POST['materialPraB4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira B.4';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Bau C -->
  <div class="modal fade" id="siteModal23" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bau C</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau C'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauC">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialBauC'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Bau C'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialBauC'])) {
              $material = $_POST['materialBauC'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Bau C';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira C.1 -->
  <div class="modal fade" id="siteModal24" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
            ?>
            <?php
            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira C.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>

            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraC1'])) {
              $material = $_POST['materialPraC1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira C.1';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Prateleira C.2 -->
  <div class="modal fade" id="siteModal25" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira C.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraC2'])) {
              $material = $_POST['materialPraC2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira C.2';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta C.1-->
  <div class="modal fade" id="siteModal26" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.1</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.1'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC1'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.1'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC1'])) {
              $material = $_POST['materialGavetaC1'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.1';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta C.4 -->
  <div class="modal fade" id="siteModal27" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.4</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC4'])) {
              $material = $_POST['materialGavetaC4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.4';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!-- Modal Gaveta C.2 -->
  <div class="modal fade" id="siteModal28" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.2</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.2'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC2'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.2'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC2'])) {
              $material = $_POST['materialGavetaC2'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.2';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- Modal Gaveta C.5 --------------------------------------->

  <div class="modal fade" id="siteModal29" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.5</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.5'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC5">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC5'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.5'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC5'])) {
              $material = $_POST['materialGavetaC5'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.5';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- Modal Gaveta C.3 --------------------------------------->


  <div class="modal fade" id="siteModal30" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC3'])) {
              $material = $_POST['materialGavetaC3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- Modal Gaveta C.6 --------------------------------------->

  <div class="modal fade" id="siteModal31" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.6</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.6'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC6'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Gaveta C.6'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialGavetaC6'])) {
              $material = $_POST['materialGavetaC6'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Gaveta C.6';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- Modal Prateleira C.3 --------------------------------------->

  <div class="modal fade" id="siteModal32" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.3</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.3'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC3'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira C.3'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraC3'])) {
              $material = $_POST['materialPraC3'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira C.3';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- Modal Prateleira C.4 --------------------------------------->

  <div class="modal fade" id="siteModal33" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.4 </h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $dbnome = "lab";
            $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

            $sql = "SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.4'";
            $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($registro = mysqli_fetch_array($resultado)) {
              $nome = $registro['fk_material'];
              $qtde = $registro['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC4'];
                  $sql = "SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira C.4'";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $alocacao = $registro['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
                mysqli_close($conn);
                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputUsuario">Retirar</label>
              <input type="text" class="form-control" onkeyup="num(this);" name="quantidade" placeholder="Retirar">
            </div>
            <?php
            require_once 'sql.php';
            $sql = new Sql;

            if (isset($_POST['materialPraC4'])) {
              $material = $_POST['materialPraC4'];
              $quantidade = $_POST['quantidade'];
              $localizacao = 'Prateleira C.4';

              //verificar se os campos estão todos preenchidos
              if (!empty($material) && !empty($quantidade)) {
                $sql->conectar("lab", "localhost", "root", "");
                if ($sql->msgErro == "") {
                  if ($sql->retirarMaterial($material, $quantidade, $localizacao)) {
                    ?>
                    <div class="alert alert-success" role="alert">
                      Material retirado.
                    </div>
                  <?php
                } else {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      Você não pode retirar mais do que tem.
                    </div>
                  <?php
                }
              } else {
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
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Retirar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  <!----------------------------------- CADASTRO DE MATERIAL --------------------------------------->

<?php
}
if ($action == 'material') {
  // Cadastro de material 
  require_once 'classes/material.php';
  $material = new material;
  if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $descri = $_POST['descri'];
    $tipo = $_POST['tipo'];
    //verificar se os campos estão todos preenchidos
    if (!empty($nome) && !empty($tipo)) {
      $material->conectar("lab", "localhost", "root", "");
      if ($material->msgErro == "") {
        if ($material->cadastrar($nome, $descri, $tipo)) {
          ?>
          <div class="alert alert-success" role="alert">
            Material cadastrado.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Material já está cadastrado.
          </div>
        <?php
      }
    } else {
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastro de Material</h5>
        <a href="index.php"> <img src="img/cancelar.png" /></a>
        </a>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputNome4">Nome_Modelo</label>
                <input type="text" class="form-control" id="inputNome4" name="nome" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="inputDescricao">Descrição</label>
                <input type="text" class="form-control" id="inputDescricao" name="descri" placeholder="Descrição do Material">
              </div>
              <div class="form-row"></div>
              &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                <label for="inputModelo">Tipo</label>
                <select id="inputModelo" class="form-control" name="tipo">
                  <option selected></option>
                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                  <?php
                  $servidor = "localhost";
                  $usuario = "root";
                  $senha = "";
                  $dbnome = "lab";
                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                  ?>
                  <div class="tabela">
                    <?php
                    $sql = "SELECT * FROM tipo_material";
                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                    while ($registro = mysqli_fetch_array($resultado)) {
                      $tipo = $registro['tipo'];
                      ?>
                      <option value="<?php echo " $tipo "; ?>"> <?php echo " $tipo "; ?> </option>
                    <?php
                  }
                  mysqli_close($conn);
                  ?>
                </select>
                <!-- Faz uma conexão com o banco de dados, e cadastra o material -->
                </select>
              </div>
            </div>
            <hr />
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>
  </div>
  <!----------------------------------- CADASTRO DE EQUIPAMENTO --------------------------------------->

<?php
}
if ($action == 'equipamento') {
  ?>
  <?php
  require_once 'classes/equipamento.php';
  $equipamento = new equipamento;
  if (isset($_POST['situacao'])) {
    $nome_equipamento = $_POST['nome_modelo'];
    $codigo = $_POST['codigo'];
    $status = $_POST['situacao'];

    //verificar se os campos estão todos preenchidos
    if (!empty($nome_equipamento) && !empty($codigo)) {
      $equipamento->conectar("lab", "localhost", "root", "");
      if ($equipamento->msgErro == "") {
        if ($equipamento->cadastrar($nome_equipamento, $codigo, $status)) {
          ?>
          <div class="alert alert-success" role="alert">
            Equipamento cadastrado.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Equipamento já está cadastrado.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $equipamento->msgErro;
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastro de Equipamento</h5>
        <a href="index.php"> <img src="img/cancelar.png" /></a>
        </a>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="POST">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="campo1">Nome_Modelo</label>
                <input type="text" class="form-control" name="nome_modelo">
              </div>
              <div class="form-group col-md-6">
                <label for="campo1">Service Tag/IMEI</label>
                <input type="text" class="form-control" name="codigo">
              </div>
              <div>
                <input id="hidden" type="hidden" value="disponivel" name="situacao">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <!----------------------------------- ALOCAÇÃO DE MATERIAL --------------------------------------->

<?php
}
if ($action == 'alocacao') {
  ?>
  <?php
  require_once 'classes/alocacaomaterial.php';
  $alocacao = new alocacao;
  if (isset($_POST['material'])) {
    $nome_material = $_POST['material'];
    $qtde = $_POST['quantidade'];
    $localizacao = $_POST['localizacao'];

    //verificar se os campos estão todos preenchidos
    if (!empty($nome_material) && !empty($qtde) && !empty($localizacao)) {
      $alocacao->conectar("lab", "localhost", "root", "");
      if ($alocacao->msgErro == "") {
        if ($alocacao->cadastrar($nome_material, $qtde, $localizacao)) {
          ?>
          <div class="alert alert-success" role="alert">
            Alocação cadastrada.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-danger" role="alert">
            Alocação atualizada.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $alocacao->msgErro;
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alocação de Material</h5>
        <a href="index.php"> <img src="img/cancelar.png" /></a>
        </a>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputST">Adicionar Material</label>
                <select id="inputST" class="form-control" name="material">
                  <option selected></option>
                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a localização cadastrada -->
                  <?php
                  $servidor = "localhost";
                  $usuario = "root";
                  $senha = "";
                  $dbnome = "lab";
                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                  ?>
                  <div class="tabela">
                    <?php
                    $material = $_POST['material'];
                    $sql = "SELECT nome_modelo FROM material";
                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                    while ($registro = mysqli_fetch_array($resultado)) {
                      $material = $registro['nome_modelo'];
                      ?>
                      <option value="<?php echo "$material "; ?>"> <?php echo "$material"; ?> </option>
                    <?php
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputUsuario">Quantidade</label>
                <input type="text" class="form-control" onkeyup="num(this);" id="inputUsario" name="quantidade" placeholder="Qtd">
              </div>
              <div class="form-group col-md-6">
                <label for="inputST">Escolher Localização</label>
                <select id="inputST" class="form-control" name="localizacao">
                  <option selected></option>
                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a localização cadastrada -->
                  <?php
                  $servidor = "localhost";
                  $usuario = "root";
                  $senha = "";
                  $dbnome = "lab";
                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                  ?>
                  <div class="tabela">
                    <?php
                    $localizacao = $_POST['localizacao'];
                    $sql = "SELECT localizacao FROM localizacao";
                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                    while ($registro = mysqli_fetch_array($resultado)) {
                      $localizacao = $registro['localizacao'];
                      ?>
                      <option value="<?php echo "$localizacao "; ?>"> <?php echo "$localizacao"; ?> </option>
                    <?php
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Salvar" />
            </div>
        </div>
      </div>
    </div>
    <!----------------------------------- STATUS EQUIPAMENTO --------------------------------------->
  <?php
}
if ($action == 'statusequipamento') {
  ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Status Equipamento</h5>
          <a href="?" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
        </div>
        <div class="modal-body">
          <div class="container">
            <form method="POST">
              <div class="row">
                <div class="form-group col-md-12">
                  <!-- Faz uma conexão com o banco de dados, retorna uma lista de equipamentos e seus status -->
                  <?php
                  $servidor = "localhost";
                  $usuario = "root";
                  $senha = "";
                  $dbnome = "lab";
                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                  ?>
                  <div>
                    <?php
                    $sql = "SELECT * FROM equipamento";
                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                    echo '<table  class="table table-hover">';
                    echo '<tr>';
                    echo '<td><b>Nome_modelo</td>';
                    echo '<td><b>Service_tag/IMEI</td>';
                    echo '<td><b>Status</td>';
                    echo '</tr>';
                    while ($registro = mysqli_fetch_array($resultado)) {
                      $nome = $registro['nome_modelo'];
                      $codigo = $registro['codigo'];
                      $situacao = $registro['situacao'];
                      echo '<tr>';
                      echo '<td>' . $nome . '</td>';
                      echo '<td>' . $codigo . '</td>';
                      echo '<td>' . $situacao . '</td>';
                      echo '</tr>';
                    }
                    echo '</table>';
                    ?>
                    <?php
                    mysqli_close($conn);
                    ?>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <a href="?" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</a>
              </div>
          </div>
        </div>
        <!----------------------------------- NOVO EMPRÉSTIMO --------------------------------------->

      <?php
    }
    if ($action == 'emprestimo') {
      ?>
        <div class="container">
          <div class="row">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Novo Emprestimo</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form action="emprestimo.php" method="POST">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="inputModelo">Nome_Modelo</label>
                          <select id="inputModelo" class="form-control">
                            <option selected>Escolher...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputST">Service Tag/IMEI</label>
                          <select id="inputST" class="form-control">
                            <option selected>Escolher...</option>
                            <option>...</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputUsuario">Usuário</label>
                          <input type="text" class="form-control" id="inputUsario" placeholder="Usuario">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail">Email</label>
                          <input type="email" class="form-control" id="inputemail" placeholder="email">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputDataInicio">Data Inicio</label>
                          <input type="date" class="form-control" id="inputDataInicio" placeholder="DataInicio">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputDataFim">Data Fim</label>
                          <input type="date" class="form-control" id="inputDataFim" placeholder="DataFim">
                        </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" value="Salvar" />
                </div>
              </div>
            </div>
            <!----------------------------------- DEVOLUÇÃO DE EMPRÉSTIMO --------------------------------------->

          <?php
        }
        if ($action == 'devolucao') {
          ?>
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Devolução de Emprestimo</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form action="devolucaoemprestimo.php" method="POST">
                      <div class="row"></div>
                      <div class="form-group col-md-6">
                        <label for="inputST">Service Tag/IMEI</label>
                        <select id="inputST" class="form-control">
                          <option selected>Escolher...</option>
                          <option>...</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputDataFim">Data de Devolução</label>
                        <input type="date" class="form-control" id="inputDataDevolucao" placeholder="DataDevolucao">
                      </div>
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" value="Salvar">
                </div>
              </div>
            </div>
            <!----------------------------------- ESTOQUE HARDWARE --------------------------------------->

          <?php
        }

        if ($action == 'hardware') {
          
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
                  Material alterado com sucesso.
                </div>
              <?php
            } else {
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
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Estoque de Hardware</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form method="POST">
                      <!-- Faz uma conexão com o banco de dados, retorna uma lista com materiais com tipo igual a hardware -->
                      <?php
                      $servidor = "localhost";
                      $usuario = "root";
                      $senha = "";
                      $dbnome = "lab";
                      $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);
                      $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                      $sql = "SELECT id, nome_modelo, descricao FROM material WHERE fk_tipo=' Hardware';";
                      $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar buscar registro");
                      echo '<table  class="table table-hover">';
                      echo '<tr>';
                      echo '<th>Nome_modelo</th>';
                      echo '<th>Descrição</th>';
                      echo '<th>Ações</th>';
                      echo '</tr>';
                      while ($registro = mysqli_fetch_array($resultado)) {
                        $nome = $registro['nome_modelo'];
                        $desc = $registro['descricao'];
                        $id = $registro['id'];
                        echo '<tr>';
                        echo '<td>' . $nome . '</td>';
                        echo '<td>' . $desc . '</td>';
                        echo '<td>' ?> <a href="excluirHardware.php?id=<?= $id ?>"> <img src="img/excluir4.png" /></a>
                        <a href="#"><img src="img/editar.png" data-toggle="modal" data-target="#exampleModal" /></a>
                        <?php
                        echo '</tr>';
                      }
                      echo '</table>';
                      mysqli_close($conn);
                      ?>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                              <a href="index.php?pagina=home&action=hardware"> <img src="img/cancelar.png" /></a>
                            </div>
                            <div class="modal-body">
                              <div class="container">
                                <form method="POST">
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <input type="hidden" name="id" value="<?= $id; ?>">
                                      <label for="inputNome4">Nome_Modelo</label>
                                      <input type="text" class="form-control" id="inputNome4" name="nome" placeholder="Nome">
                                    </div>
                                    <div class="form-group">
                                      <label for="inputDescricao">Descrição</label>
                                      <input type="text" class="form-control" id="inputDescricao" name="descri" placeholder="Descrição do Material">
                                    </div>
                                    <div class="form-row"></div>
                                    &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                                      <label for="inputModelo">Tipo</label>
                                      <select id="inputModelo" class="form-control" name="tipo">
                                        <option selected></option>
                                        <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                                        <?php
                                        $servidor = "localhost";
                                        $usuario = "root";
                                        $senha = "";
                                        $dbnome = "lab";
                                        $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                                        ?>
                                        <div class="tabela">
                                          <?php
                                          $sql = "SELECT * FROM tipo_material";
                                          $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                                          while ($registro = mysqli_fetch_array($resultado)) {
                                            $tipo = $registro['tipo'];
                                            ?>
                                            <option value="<?php echo " $tipo "; ?>"> <?php echo " $tipo "; ?> </option>
                                          <?php
                                        }
                                        mysqli_close($conn);
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                  </div>
                              </div>
                            </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!----------------------------------- ESTOQUE IMPRESSÃO --------------------------------------->
        <?php
      }
      if ($action == 'impressao') {
        
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
              Material alterado com sucesso.
              </div>
            <?php
          } else {
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Estoque de Impressão</h5>
                <a href="index.php"> <img src="img/cancelar.png" /></a>
                </a>
              </div>
              <div class="modal-body">
                <div class="container">
                  <form method="POST">
                    <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materias com tipo igual a impressão -->
                    <?php
                    $servidor = "localhost";
                    $usuario = "root";
                    $senha = "";
                    $dbnome = "lab";
                    $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

                    $sql = "SELECT id, nome_modelo, descricao FROM material WHERE fk_tipo=' Impressao';";
                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar buscar registro");
                    echo '<table  class="table table-hover">';
                    echo '<tr>';
                    echo '<th>Nome_modelo</th>';
                    echo '<th>Descrição</th>';
                    echo '<th>Ações</th>';
                    echo '</tr>';
                    while ($registro = mysqli_fetch_array($resultado)) {
                      $nome = $registro['nome_modelo'];
                      $desc = $registro['descricao'];
                      $id = $registro['id'];
                      echo '<tr>';
                      echo '<td>' . $nome . '</td>';
                      echo '<td>' . $desc . '</td>';
                      echo '<td>' ?> <a href="excluirImpressao.php?id=<?= $id ?>"> <img src="img/excluir4.png" /></a>
                      <a href="#"><img src="img/editar.png" data-toggle="modal" data-target="#exampleModal" /></a>
                      <?php
                      echo '</tr>';
                    }
                    echo '</table>';
                    mysqli_close($conn);
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                            <a href="index.php?pagina=home&action=impressao"> <img src="img/cancelar.png" /></a>
                          </div>
                          <div class="modal-body">
                            <div class="container">
                              <form method="POST">
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    <label for="inputNome4">Nome_Modelo</label>
                                    <input type="text" class="form-control" id="inputNome4" name="nome" placeholder="Nome">
                                  </div>
                                  <div class="form-group">
                                    <label for="inputDescricao">Descrição</label>
                                    <input type="text" class="form-control" id="inputDescricao" name="descri" placeholder="Descrição do Material">
                                  </div>
                                  <div class="form-row"></div>
                                  &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                                    <label for="inputModelo">Tipo</label>
                                    <select id="inputModelo" class="form-control" name="tipo">
                                      <option selected></option>
                                      <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                                      <?php
                                      $servidor = "localhost";
                                      $usuario = "root";
                                      $senha = "";
                                      $dbnome = "lab";
                                      $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                                      ?>
                                      <div class="tabela">
                                        <?php
                                        $sql = "SELECT * FROM tipo_material";
                                        $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                                        while ($registro = mysqli_fetch_array($resultado)) {
                                          $tipo = $registro['tipo'];
                                          ?>
                                          <option value="<?php echo " $tipo "; ?>"> <?php echo " $tipo "; ?> </option>
                                        <?php
                                      }
                                      mysqli_close($conn);
                                      ?>
                                    </select>
                                  </div>
                                </div>
                            
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </div>
                            </div>
                          </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!----------------------------------- ESTOQUE TELEFONIA --------------------------------------->
      <?php
    }
    if ($action == 'telefonia') {
      
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
            Material alterado com sucesso.
            </div>
          <?php
        } else {
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
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Estoque de Telefonia</h5>
              <a href="index.php"> <img src="img/cancelar.png" /></a>
              </a>
            </div>
            <div class="modal-body">
              <div class="container">
                <form method="POST">
                  <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materias com tipo telefonia -->
                  <?php
                  $servidor = "localhost";
                  $usuario = "root";
                  $senha = "";
                  $dbnome = "lab";
                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

                  $sql = "SELECT id, nome_modelo, descricao FROM material WHERE fk_tipo=' Telefonia';";
                  $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar buscar registro");
                  echo '<table  class="table table-hover">';
                  echo '<tr>';
                  echo '<th>Nome_modelo</th>';
                  echo '<th>Descrição</th>';
                  echo '<th>Ações</th>';
                  echo '</tr>';
                  while ($registro = mysqli_fetch_array($resultado)) {
                    $nome = $registro['nome_modelo'];
                    $desc = $registro['descricao'];
                    $id = $registro['id'];
                    echo '<tr>';
                    echo '<td>' . $nome . '</td>';
                    echo '<td>' . $desc . '</td>';
                    echo '<td>' ?> <a href="excluirTelefonia.php?id=<?= $id ?>"> <img src="img/excluir4.png" /></a>
                    <a href="#"><img src="img/editar.png" data-toggle="modal" data-target="#exampleModal" /></a>
                    <?php
                    echo '</tr>';
                  }
                  echo '</table>';
                  mysqli_close($conn);
                  ?>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                          <a href="index.php?pagina=home&action=telefonia"> <img src="img/cancelar.png" /></a>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <form method="POST">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="hidden" name="id" value="<?= $id; ?>">
                                  <label for="inputNome4">Nome_Modelo</label>
                                  <input type="text" class="form-control" id="inputNome4" name="nome" placeholder="Nome">
                                </div>
                                <div class="form-group">
                                  <label for="inputDescricao">Descrição</label>
                                  <input type="text" class="form-control" id="inputDescricao" name="descri" placeholder="Descrição do Material">
                                </div>
                                <div class="form-row"></div>
                                &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                                  <label for="inputModelo">Tipo</label>
                                  <select id="inputModelo" class="form-control" name="tipo">
                                    <option selected></option>
                                    <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                                    <?php
                                    $servidor = "localhost";
                                    $usuario = "root";
                                    $senha = "";
                                    $dbnome = "lab";
                                    $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                                    ?>
                                    <div class="tabela">
                                      <?php
                                      $sql = "SELECT * FROM tipo_material";
                                      $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                                      while ($registro = mysqli_fetch_array($resultado)) {
                                        $tipo = $registro['tipo'];
                                        ?>
                                        <option value="<?php echo " $tipo "; ?>"> <?php echo " $tipo "; ?> </option>
                                      <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                  </select>
                                </div>
                              </div>
                           
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                              </div>
                          </div>
                        </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!----------------------------------- ESTOQUE GERAL --------------------------------------->
    <?php
  }
  if ($action == 'geral') {
    
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
         if( $material->alterarMaterial($id, $nome, $descri, $tipo)){
          ?>
          <div class="alert alert-success" role="alert">
          Material alterado com sucesso.
          </div>
        <?php
         }
      } else {
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Estoque Geral</h5>
            <a href="index.php"> <img src="img/cancelar.png" /></a>
            </a>
          </div>
          <div class="modal-body">
            <div class="container">
              <form method="POST">
                <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materiais cadastrados -->
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbnome = "lab";
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

                $sql = "SELECT id, nome_modelo, descricao FROM material;";
                $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar buscar registro");
                echo '<table  class="table table-hover">';
                echo '<tr>';
                echo '<th>Nome_modelo</th>';
                echo '<th>Descrição</th>';
                echo '<th>Ações</th>';
                echo '</tr>';
                while ($registro = mysqli_fetch_array($resultado)) {
                  $nome = $registro['nome_modelo'];
                  $desc = $registro['descricao'];
                  $id = $registro['id'];
                   
                  echo '<tr>';
                  echo '<td>' . $nome . '</td>';
                  echo '<td>' . $desc . '</td>';
                  echo '<td>' ?><a href="excluirGeral.php?id=<?= $id; ?>"><img src="img/excluir4.png" /></a>
                  <a href="#"><img src="img/editar.png" data-toggle="modal" data-target="#exampleModal" /></a>
                  <?php
                  echo '</tr>';
                }
                echo '</table>';
               
                mysqli_close($conn);
                ?>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Material</h5>
                        <a href="index.php?pagina=home&action=geral"> <img src="img/cancelar.png" /></a>
                      </div>
                      <div class="modal-body">
                        <div class="container">
                          <form method="POST">
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <label for="inputNome4">Nome_Modelo</label>
                                <input type="text" class="form-control" id="inputNome4" name="nome" placeholder="Nome">
                              </div>
                              <div class="form-group">
                                <label for="inputDescricao">Descrição</label>
                                <input type="text" class="form-control" id="inputDescricao" name="descri" placeholder="Descrição do Material">
                              </div>
                              <div class="form-row"></div>
                              &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                                <label for="inputModelo">Tipo</label>
                                <select id="inputModelo" class="form-control" name="tipo">
                                  <option selected></option>
                                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                                  <?php
                                  $servidor = "localhost";
                                  $usuario = "root";
                                  $senha = "";
                                  $dbnome = "lab";
                                  $conn = mysqli_connect($servidor, $usuario, $senha, $dbnome)
                                  ?>
                                  <div class="tabela">
                                    <?php
                                    $sql = "SELECT * FROM tipo_material";
                                    $resultado = mysqli_query($conn, $sql) or die("Erro ao tentar cadastrar registro");
                                    while ($registro = mysqli_fetch_array($resultado)) {
                                      $tipo = $registro['tipo'];
                                      ?>
                                      <option value="<?php echo " $tipo "; ?>"> <?php echo " $tipo "; ?> </option>
                                    <?php
                                  }
                                  
                                  mysqli_close($conn);
                                  ?>
                                </select>
                              </div>
                            </div>
                          
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </div>
                        </div>
                      </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
}
?>