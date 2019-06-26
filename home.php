<nav class="navbar navbar-fixed-top navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand h1 mb-0" style="font-family: Impact, fantasy; font-size: 22px;" href="index.php">Laboratory Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSite">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" data-toggle="dropdown" id="navDrop">
            Armário
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=home&action=material" role="button">Cadastro de Material</a>
            <a class="dropdown-item" href="?pagina=home&action=alocacao" role="button">Alocação de Material</a>
            <a class="dropdown-item" href="?pagina=home&action=armario" role="button">Exibir Armários</a>
            <a class="dropdown-item" href="?pagina=home&action=editar" role="button">Editar Materiais</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" data-toggle="dropdown" id="navDrop">
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
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" data-toggle="dropdown" id="navDrop">
            Empréstimo
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=home&action=equipamento" role="button">Cadastro de Equipamento</a>
            <a class="dropdown-item" href="?pagina=home&action=statusequipamento" role="button">Status Equipamento</a>
            <a class="dropdown-item" href="?pagina=home&action=emprestimo" role="button">Novo Empréstimo</a>
            <a class="dropdown-item" href="?pagina=home&action=devolucao" role="button">Devolução de Empréstimo</a>
            <a class="dropdown-item" href="?pagina=home&action=listaEmprestimo" role="button">Lista de Empréstimo</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="margin-left:310px; color:white;" href=""> Seja Bem vindo <?php echo $_SESSION['nome']; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="margin-left: 15px; color: white;" href="sair.php">
            Sair
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
$action = '';
//$cor = 'yellow';
//$gavetasCor = ['Bau A' => 'Bau A', 'Bau B' => 'Bau B', 'Bau C' => 'Bau C', 'Gaveta B.1' => 'Gaveta B.1'];

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}
if ($action == 'armario') {
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-body" style=" height:890px;">
        <div class="table-responsive col-md-12">
          <div id="main" class="container" style="margin-top: 50px;">
            </a>
            <nav class="navbar navbar-light bg-light" style="width: 100%;">
              <form class="form-inline ml-auto" method="POST" style="width: 100%;">
                <input type="text" name="material" class="form-control" placeholder="Qual material você procura?">
                <input type="image" src="img/lupa.png" alt="submit" /></a>
                <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" style="margin-left:1060px" /></a>
                <?php
                require_once 'classes/material.php';
                require_once 'conexao.php';
                $conn = new Conexao;
                $mat = new Material;
                if (isset($_POST['material'])) {
                  $material = $_POST['material'];
                  //verificar se os campos estão todos preenchidos
                  if (!empty($material)) {
                    $conn->conectar();
                    if ($conn->msgErro == "") {
                      if ($mat->buscarMaterial($material)) {
                        $sql = $pdo->prepare("SELECT * FROM alocacao WHERE fk_material LIKE :material");
                        $sql->bindValue(":material", $material . "%");
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
                        <div>
                          Nenhum material localizado.
                        </div>
                      <?php
                    }
                  } else {
                    ?>
                      <div style="bottom:882px;" class="msn-erro">
                        <?php
                        echo "erro: " . $conn->msgErro;
                        ?>
                      </div>
                    <?php
                  }
                } else {
                  ?>
                    <div>
                      Preencha todos os campos.
                    </div>
                  <?php
                }
              }
              ?>
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

  <!--###################################################### MODAIS ####################################################-->

  <!--####################################################### BAU A ####################################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialBauA'])) {
    $material = $_POST['materialBauA'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Bau A';

    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px; " class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma lista de materiais -->
            <?php

            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau A'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauA">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialbauA'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Bau A'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>

  <!--################################################ Modal Prateleira A.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraA1'])) {
    $material = $_POST['materialPraA1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira A.1';

    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px; " class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma lista de materiais -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraA1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>

  <!--################################################ Modal Prateleira A.2 ##########################################-->

  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraA2'])) {
    $material = $_POST['materialPraA2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira A.2';

    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA2">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraA2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao = 'Prateleira A.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA1'])) {
    $material = $_POST['materialGavetaA1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.1';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA4'])) {
    $material = $_POST['materialGavetaA4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.4';


    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA4">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.2 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA2'])) {
    $material = $_POST['materialGavetaA2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.2';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA2">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.5 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA5'])) {
    $material = $_POST['materialGavetaA5'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.5';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
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
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.5'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA5">
                <option selected>Escolher...</option>

                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA5'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.5'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA3'])) {
    $material = $_POST['materialGavetaA3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
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
  <div class="modal fade" id="siteModal8" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">

            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->

                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta A.6 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaA6'])) {
    $material = $_POST['materialGavetaA6'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta A.6';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal9" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta A.6</h5>
          <<a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
            </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta A.6'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaA6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaA6'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta A.6'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira A.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraA3'])) {
    $material = $_POST['materialPraA3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira A.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal10" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraA3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira A.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira A.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraA4'])) {
    $material = $_POST['materialPraA4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira A.4';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal11" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira A.4</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira A.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraA4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraA4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira A.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Bau B ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialBauB'])) {
    $material = $_POST['materialBauB'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Bau B';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal12" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bau B</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau B'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauB">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialBauB'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Bau B'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira B.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraB1'])) {
    $material = $_POST['materialPraB1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira B.1';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal13" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.1</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira B.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira B.2 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraB2'])) {
    $material = $_POST['materialPraB2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira B.2';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal14" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.2</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira B.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB1'])) {
    $material = $_POST['materialGavetaB1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.1';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal15" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.1</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB4'])) {
    $material = $_POST['materialGavetaB4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.4';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal16" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.4</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.2 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB2'])) {
    $material = $_POST['materialGavetaB2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.2';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal17" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.2</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.5 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB5'])) {
    $material = $_POST['materialGavetaB5'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.5';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal18" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.5</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.5'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB5">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB5'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.5'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB3'])) {
    $material = $_POST['materialGavetaB3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal19" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta B.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Gaveta B.6 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaB6'])) {
    $material = $_POST['materialGavetaB6'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta B.6';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal20" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.6</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta B.6'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaB6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaB6'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta B.6'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira B.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraB3'])) {
    $material = $_POST['materialPraB3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira B.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal21" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira B.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Modal Prateleira B.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraB4'])) {
    $material = $_POST['materialPraB4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira B.4';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal22" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira B.4</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira B.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraB4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraB4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira B.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################  Bau C ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialBauC'])) {
    $material = $_POST['materialBauC'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Bau C';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal23" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bau C</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Bau C'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialBauC">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialBauC'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Bau C'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Prateleira C.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraC1'])) {
    $material = $_POST['materialPraC1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira C.1';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal24" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.1</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira C.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Prateleira C.2 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraC2'])) {
    $material = $_POST['materialPraC2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira C.2';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal25" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.2</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira C.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.1 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC1'])) {
    $material = $_POST['materialGavetaC1'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.1';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal26" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.1</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.1'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC1">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC1'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.1'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC4'])) {
    $material = $_POST['materialGavetaC4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.4';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal27" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.4</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.2 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC2'])) {
    $material = $_POST['materialGavetaC2'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.2';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal28" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.2</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.2'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC2">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC2'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.2'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.5 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC5'])) {
    $material = $_POST['materialGavetaC5'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.5';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal29" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.5</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.5'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC5">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC5'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.5'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC3'])) {
    $material = $_POST['materialGavetaC3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal30" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Gaveta C.6 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialGavetaC6'])) {
    $material = $_POST['materialGavetaC6'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Gaveta C.6';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal31" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gaveta C.6</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Gaveta C.6'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialGavetaC6">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialGavetaC6'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Gaveta C.6'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Prateleira C.3 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraC3'])) {
    $material = $_POST['materialPraC3'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira C.3';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal32" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.3</h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.3'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC3">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC3'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira C.3'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--################################################ Prateleira C.4 ##########################################-->
  <?php
  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['materialPraC4'])) {
    $material = $_POST['materialPraC4'];
    $quantidade = $_POST['quantidade'];
    $localizacao = 'Prateleira C.4';

    //verificar se os campos estão todos preenchidos
    if (!empty($material) && !empty($quantidade)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->retirarMaterial($material, $quantidade, $localizacao)) {
          ?>
          <div style="bottom:880px;" class="alert alert-success" role="alert">
            Material retirado.
          </div>
        <?php
      } else {
        ?>
          <div style="bottom:880px;" class="alert alert-danger" role="alert">
            Você não pode retirar mais do que tem.
          </div>
        <?php
      }
    } else {
      ?>
        <div style="bottom:880px;" class="msn-erro">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div style="bottom:880px;" class="alert alert-danger" role="alert">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal fade" id="siteModal33" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Prateleira C.4 </h5>
          <a href="?" class="close" data-dismiss="modal"><img src="img/cancelar.png" /></a>
        </div>
        <div class="modal-body">
          <h4 class="modal-body">Lista</h4>
          <form method="POST">
            <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
            <?php
            require_once 'conexao.php';

            $conn = new Conexao;
            $conn->conectar();
            $sql = $pdo->prepare("SELECT fk_material, quantidade FROM alocacao WHERE fk_localizacao ='Prateleira C.4'");
            $sql->execute();
            echo '<table  class="table table-hover">';
            echo '<tr>';
            echo '<td><b>Nome_modelo</td>';
            echo '<td><b>Quantidade</td>';
            echo '</tr>';
            while ($dados = $sql->fetch()) {
              $nome = $dados['fk_material'];
              $qtde = $dados['quantidade'];
              echo '<tr>';
              echo '<td>' . $nome . '</td>';
              echo '<td>' . $qtde . '</td>';
              echo '</tr>';
            }
            echo '</table>';
            ?>
            <div class="row"></div>
            <div class="form-group col-md-6">
              <label for="inputModelo">Selecione Material</label>
              <select id="inputModelo" class="form-control" name="materialPraC4">
                <option selected>Escolher...</option>
                <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a alocacao cadastrada -->
                <?php
                require_once 'conexao.php';
                $conn = new Conexao;
                $conn->conectar();
                ?>
                <div class="tabela">
                  <?php
                  $material = $_POST['materialPraC4'];
                  $sql = $pdo->prepare("SELECT fk_material FROM alocacao WHERE fk_localizacao ='Prateleira C.4'");
                  $sql->execute();
                  while ($dados = $sql->fetch()) {
                    $alocacao = $dados['fk_material'];
                    ?>
                    <option value="<?php echo "$alocacao "; ?>"> <?php echo "$alocacao"; ?> </option>
                  <?php
                }
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
        </div>
      </div>
      </form>
    </div>
  </div>
  <!--########################################### CADASTRO DE MATERIAL ################################################-->
<?php
}
if ($action == 'material') {

  require_once 'conexao.php';
  require_once 'classes/material.php';

  $conn = new Conexao;
  $mat = new Material;

  if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $descri = $_POST['descri'];
    $tipo = $_POST['tipo'];
    //verificar se os campos estão todos preenchidos
    if (!empty($nome) && !empty($tipo)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($mat->cadastrar($nome, $descri, $tipo)) {
          ?>
          <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Material cadastrado.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Material já está cadastrado.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro" style="margin-top: 10px; margin-bottom:-60px;">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal-dialog" role="document" style="margin-top: 110px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cadastro de Material</h5>
        <a href="index.php"> <img src="img/cancelar.png" /></a>
      </div>
      <div class="modal-body">
        <div class="container">
          <form method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputNome4">Nome_Modelo</label>
                <input type="text" class="form-control" id="inputNome4" maxlength="20" name="nome" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="inputDescricao">Descrição</label>
                <input type="text" class="form-control" id="inputNome4" maxlength="30" name="descri" placeholder="Descrição do Material">
              </div>
              <div class="form-row"></div>
              &nbsp;&nbsp;&nbsp;&nbsp; <div class="form-group col-md-4">
                <label for="inputModelo">Tipo</label>
                <select id="inputModelo" class="form-control" name="tipo">
                  <option selected></option>
                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->
                  <?php
                  require_once 'conexao.php';

                  $conn = new Conexao;
                  $conn->conectar();
                  ?>
                  <div class="tabela">
                    <?php
                    $sql = $pdo->prepare("SELECT * FROM tipo_material");
                    $sql->execute();
                    while ($dados = $sql->fetch()) {
                      $tipo = $dados['tipo'];
                      ?>
                      <option value="<?php echo "$tipo "; ?>"> <?php echo "$tipo"; ?> </option>
                    <?php
                  }
                  ?>
                </select>
                <!-- Faz uma conexão com o banco de dados, e cadastra o material -->
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>
  </div>
  <!--########################################### CADASTRO DE EQUIPAMENTO ################################################-->
<?php
}
if ($action == 'equipamento') {

  require_once 'classes/equipamento.php';
  require_once 'conexao.php';

  $conn = new Conexao;
  $equipamento = new Equipamento;

  if (isset($_POST['situacao'])) {
    $nome_equipamento = $_POST['nome_modelo'];
    $codigo = $_POST['codigo'];
    $status = $_POST['situacao'];

    //verificar se os campos estão todos preenchidos
    if (!empty($nome_equipamento) && !empty($codigo)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($equipamento->cadastrar($nome_equipamento, $codigo, $status)) {
          ?>
          <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Equipamento cadastrado.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Equipamento já está cadastrado.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro" style="margin-top: 10px; margin-bottom:-60px;">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
        Preencha todos os campos.
      </div>
    <?php
  }
}
?>
  <div class="modal-dialog" role="document" style="margin-top: 110px;">
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
                <input type="text" class="form-control" maxlength="20" name="nome_modelo">
              </div>
              <div class="form-group col-md-6">
                <label for="campo1">Service Tag/IMEI</label>
                <input type="text" class="form-control" onkeyup="num(this);" maxlength="15" name="codigo">
              </div>
              <div>
                <input id="hidden" type="hidden" value="Disponivel" name="situacao">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <!----------------------------------- ALOCAÇÃO DE MATERIAL --------------------------------------->

<?php
}
if ($action == 'alocacao') {

  require_once 'classes/alocacaomaterial.php';
  require_once 'conexao.php';

  $conn = new Conexao;
  $alocacao = new alocacao;

  if (isset($_POST['material'])) {
    $nome_material = $_POST['material'];
    $qtde = $_POST['quantidade'];
    $localizacao = $_POST['localizacao'];

    //verificar se os campos estão todos preenchidos
    if (!empty($nome_material) && !empty($qtde) && !empty($localizacao)) {
      $conn->conectar();
      if ($conn->msgErro == "") {
        if ($alocacao->cadastrar($nome_material, $qtde, $localizacao)) {
          ?>
          <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Alocação cadastrada.
          </div>
        <?php
      } else {
        ?>
          <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
            Alocação atualizada.
          </div>
        <?php
      }
    } else {
      ?>
        <div class="msn-erro" style="margin-top: 10px; margin-bottom:-60px;">
          <?php
          echo "erro: " . $conn->msgErro;
          ?>
        </div>
      <?php
    }
  } else {
    ?>
      <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
        Preencha todos os campos.
      </div>
    <?php
  }
}

?>
  <div class="modal-dialog" role="document" style="margin-top: 70px;">
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

                  <div class="tabela">
                    <?php
                    $conn->conectar();
                    $sql = $pdo->prepare("SELECT nome_modelo FROM material");
                    $sql->execute();
                    while ($registro = $sql->fetch()) {
                      $material = $registro['nome_modelo'];
                      ?>
                      <option value="<?php echo "$material"; ?>"> <?php echo "$material"; ?> </option>
                    <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputUsuario">Quantidade</label>
                <input type="text" class="form-control" onkeyup="num(this);" id="inputUsario" name="quantidade" maxlength="5" placeholder="Qtd">
              </div>
              <div class="form-group col-md-6">
                <label for="inputST">Escolher Localização</label>
                <select id="inputST" class="form-control" name="localizacao">
                  <option selected></option>
                  <!-- Faz uma conexão com o banco de dados, retorna uma consulta com a localização cadastrada -->

                  <div class="tabela">
                    <?php
                    $conn->conectar();
                    $sql = $pdo->prepare("SELECT localizacao FROM localizacao");
                    $sql->execute();
                    while ($registro = $sql->fetch()) {
                      $localizacao = $registro['localizacao'];
                      ?>
                      <option value="<?php echo "$localizacao"; ?>"> <?php echo "$localizacao"; ?> </option>
                    <?php
                  }
                  ?>

                </select>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" value="Salvar" />
            </div>
        </div>
      </div>
    </div>
    <!----------------------------------- STATUS EQUIPAMENTO --------------------------------------->
  <?php
}
if ($action == 'statusequipamento') {

  require_once 'conexao.php';
  $conn = new Conexao;

  ?>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Status Equipamento</h5>
          <a href="?" class="close" data-dismiss="modal"> <img src="img/cancelar.png" /></a>
          </a>
        </div>
        <div class="modal-body">
          <div class="container">
            <form method="POST">
              <div class="row">
                <div class="form-group col-md-12">
                  <!-- Faz uma conexão com o banco de dados, retorna uma lista de equipamentos e seus status -->
                  <div>
                    <?php

                    $conn->conectar();
                    $sql = $pdo->prepare("SELECT * FROM equipamento ORDER BY id desc");
                    $sql->execute();

                    echo '<table  class="table table-hover">';
                    echo '<tr>';
                    echo '<td><b>Nome_modelo</td>';
                    echo '<td><b>Service_tag/IMEI</td>';
                    echo '<td><b>Status</td>';
                    echo '</tr>';

                    while ($registro = $sql->fetch()) {

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

      require_once 'classes/equipamento.php';
      require_once 'conexao.php';

      $conn = new Conexao;
      $equi = new Equipamento;

      if (isset($_POST['idEquipamento'])) {
        $equipamento = $_POST['idEquipamento'];
        $service = $_POST['service'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $dataInicio = $_POST['dataInicio'];
        $dataFim = $_POST['dataFim'];
        $dataAtual =  date('Y-m-d');
        
        if (
          !empty($equipamento) && !empty($service) && !empty($usuario) && !empty($email)
          && !empty($dataInicio) && !empty($dataFim)
        ) {
          $conn->conectar();
          
          if(strtotime($dataAtual) < strtotime($dataFim)){

          if (strtotime($dataInicio) < strtotime($dataFim)) {

            if ($conn->msgErro == "") {

              if ($equi->realizarEmprestimo($equipamento, $service, $usuario, $email, $dataInicio, $dataFim)) {
                ?>
                  <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                    Empréstimo realizado.
                  </div>
                <?php
              } else {
                ?>
                  <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                    Alocação atualizada.
                  </div>
                <?php
              }
            } else {
              ?>
                <div class="msn-erro" style="margin-top: 10px; margin-bottom:-60px;">
                  <?php
                  echo "erro: " . $conn->msgErro;
                  ?>
                </div>
              <?php
            }
          } else {
            ?>
              <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                Data do fim tem que ser maior que a data de início.
              </div>
            <?php
          }
        }else {
          ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
              Data do fim tem que ser maior que a data de Atual.
            </div>
          <?php
        }
      }
         else {
          ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
              Preencha todos os campos.
            </div>
          <?php
        }
      }
      ?>
        <div class="container">
          <div class="row">
            <div class="modal-dialog" role="document" style="margin-top: 110px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Novo Emprestimo</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <?php
                $servidor = "localhost";
                $usuario = "root";
                $senha = "";
                $dbname = "lab";
                //Criar a conexao
                $conn = mysqli_connect($servidor, $usuario, $senha, $dbname); ?>
                <div class="modal-body">
                  <div class="container">
                    <form method="POST">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="idEquipamento">Nome_Modelo</label>
                          <select name="idEquipamento" id="idEquipamento" class="form-control">
                            <option value="">Escolha o Equipamento</option>
                            <?php
                            $result_cat_post = "SELECT * FROM equipamento WHERE situacao='Disponivel' ORDER BY id desc";
                            $resultado_cat_post = mysqli_query($conn, $result_cat_post);
                            while ($row_cat_post = mysqli_fetch_assoc($resultado_cat_post)) {
                              echo '<option value="' . $row_cat_post['nome_modelo'] . '">' . $row_cat_post['nome_modelo'] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="service">Service-Tag</label>
                          <select name="service" id="service" class="form-control">
                            <option value="">Escolha a Service-Tag</option>
                          </select>
                        </div>

                        <div class="form-group col-md-6">
                          <label for="inputUsuario">Usuário</label>
                          <input type="text" class="form-control" id="inputUsario" maxlength="30" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail">Email</label>
                          <input type="email" class="form-control" id="inputemail" maxlength="50" name="email" placeholder="email">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputDataInicio">Data Inicio</label>
                          <input type="date" class="form-control" id="inputDataInicio" name="dataInicio" placeholder="DataInicio">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputDataFim">Data Fim</label>
                          <input type="date" class="form-control" id="inputDataFim" name="dataFim" placeholder="DataFim">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Salvar" />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!----------------------------------- DEVOLUÇÃO DE EMPRÉSTIMO --------------------------------------->

          <?php
        }
        if ($action == 'devolucao') {

          require_once 'classes/equipamento.php';
          require_once 'conexao.php';
    
          $conn = new Conexao;
          $equi = new Equipamento;
    
          if (isset($_POST['service'])) {
            $service = $_POST['service'];
            $data = $_POST['data'];
            
    
            if (!empty($service) && !empty($data)) {
              $conn->conectar();
    
                if ($conn->msgErro == "") {
    
                  if ($equi->realizarDevolucao($service, $data)) {
                    ?>
                      <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                        Devolução realizada.
                      </div>
                    <?php
                  } else {
                    ?>
                      <div class="alert alert-success" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                        Não foi posssivel realizar a Devolução.
                      </div>
                    <?php
                  }
                } else {
                  ?>
                    <div class="msn-erro" style="margin-top: 10px; margin-bottom:-60px;">
                      <?php
                      echo "erro: " . $conn->msgErro;
                      ?>
                    </div>
                  <?php
                }

            } else {
              ?>
                <div class="alert alert-danger" role="alert" style="margin-top: 10px; margin-bottom:-60px;">
                  Preencha todos os campos.
                </div>
              <?php
            }
          }

          $servidor = "localhost";
          $usuario = "root";
          $senha = "";
          $dbname = "lab";
          //Criar a conexao
          $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

          ?>


            <div class="modal-dialog" role="document" style="margin-top: 110px;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Devolução de Equipamento</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form method="POST">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="devolucao">Service Tag/IMEI</label>
                          <select name="service" id="service" class="form-control">
                            <option value="">Escolha a service-tag</option>
                            <?php
                            $result_cat_post = "SELECT * FROM equipamento WHERE situacao='Indisponivel' ORDER BY id desc";
                            $resultado_cat_post = mysqli_query($conn, $result_cat_post);
                            while ($row_cat_post = mysqli_fetch_assoc($resultado_cat_post)) {
                              echo '<option value="' . $row_cat_post['codigo'] . '">' . $row_cat_post['codigo'] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="campo1">Data de devolução</label>
                          <input type="Date" class="form-control" onkeyup="num(this);" maxlength="15" name="data" id="data">
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!----------------------------------- ESTOQUE HARDWARE --------------------------------------->

          <?php
        }
        if ($action == 'hardware') {

          require_once 'conexao.php';
          $conn = new Conexao;

          $conn->conectar();
          $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo 
          INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Hardware' GROUP BY fk_material");
          $sql->execute();

              //Filtro nome 
              if(isset($_POST['material'])){
                $material = $_POST['material'];
                        
                 if(!empty($material)){
                   $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
                   INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Hardware' 
                   AND fk_material = :material GROUP BY fk_material");
                   $sql->bindValue(":material",$material);
                   $sql->execute();
         
                 }
       
                   else if(empty($material)){
                     $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
                     INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Hardware' GROUP BY fk_material");
                     $sql->execute();
             
                   }
                  
               }

          ?>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Estoque de Hardware</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                </div>
                <div class="modal-body">
                  <div class="container">
                  <form class="form-row" method="POST">
                      <div class="row">
                        <div class="col-9">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Nome/Modelo">
                        </div> 
                        <div class="col-3">
                        <button type="submit" class="btn btn-success">Buscar</button>
                       </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                      </div>
                      <br>
                      </form>
                    <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materias com tipo telefonia -->
                    <?php
                    echo '<br>';
                    echo '<table  class="table table-hover">';
                    echo '<tr>';
                    echo '<th>Nome_modelo</th>';
                    echo '<th>Quantidade</th>';
                    echo '</tr>';

                    while ($registro = $sql->fetch()) {

                      $nome = $registro['fk_material'];
                      $qtd = $registro['sum(quantidade)'];

                      echo '<tr>';
                      echo '<td>' . $nome . '</td>';
                      echo '<td>' . $qtd . '</td>';
                     
                      echo '</tr>';
                    }
                    echo '</table>';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <!----------------------------------- ESTOQUE IMPRESSÃO --------------------------------------->
          <?php
        }
        if ($action == 'impressao') {

          require_once 'conexao.php';
          $conn = new Conexao;

          $conn->conectar();

          $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo INNER JOIN material mat on 
          mat.nome_modelo = alo.fk_material WHERE fk_tipo='Impressao' GROUP BY fk_material");
          $sql->execute();
    
          //Filtro nome 
          if(isset($_POST['material'])){
             $material = $_POST['material'];
                     
              if(!empty($material)){
                $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
                INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Impressao' 
                AND fk_material = :material GROUP BY fk_material");
                $sql->bindValue(":material",$material);
                $sql->execute();
      
              }
    
                else if(empty($material)){
                  $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
                  INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Impressao' GROUP BY fk_material");
                  $sql->execute();
          
                }
               
            }
          ?>
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Estoque de Impressão</h5>
                  <a href="index.php"> <img src="img/cancelar.png" /></a>
                </div>
                <div class="modal-body">
                  <div class="container">
                  <form class="form-row" method="POST">
                      <div class="row">
                        <div class="col-9">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Nome/Modelo">
                        </div> 
                        <div class="col-3">
                        <button type="submit" class="btn btn-success">Buscar</button>
                       </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                      </div>
                      <br>
                      </form>

                    <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materias com tipo telefonia -->
                    <?php
                    echo '<br>';
                    echo '<table  class="table table-hover">';
                    echo '<tr>';
                    echo '<th>Nome_modelo</th>';
                    echo '<th>Quantidade</th>';
                    echo '</tr>';

                    while ($registro = $sql->fetch()) {
                      $nome = $registro['fk_material'];
                      $qtd = $registro['sum(quantidade)'];

                      echo '<tr>';
                      echo '<td>' . $nome . '</td>';
                      echo '<td>' . $qtd . '</td>';
                      echo '</tr>';
                    }
                    echo '</table>';
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!----------------------------------- ESTOQUE TELEFONIA --------------------------------------->
        <?php
      }
      if ($action == 'telefonia') {

        require_once 'conexao.php';
        $conn = new Conexao;

        $conn->conectar();

        $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
        INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Telefonia' GROUP BY fk_material");
        $sql->execute();
  
        //Filtro nome 
        if(isset($_POST['material'])){
           $material = $_POST['material'];
                   
            if(!empty($material)){
              $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
              INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Telefonia' 
              AND fk_material = :material GROUP BY fk_material");
              $sql->bindValue(":material",$material);
              $sql->execute();
    
            }
  
              else if(empty($material)){
                $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao alo
                INNER JOIN material mat on mat.nome_modelo = alo.fk_material WHERE fk_tipo='Telefonia' GROUP BY fk_material");
                $sql->execute();
        
              }
             
          }
        ?>
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Estoque de Telefonia</h5>
                <a href="index.php"> <img src="img/cancelar.png" /></a>
              </div>
              <div class="modal-body">
                <div class="container">
                <form class="form-row" method="POST">
                      <div class="row">
                        <div class="col-9">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Nome/Modelo">
                        </div> 
                        <div class="col-3">
                        <button type="submit" class="btn btn-success">Buscar</button>
                       </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                      </div>
                      <br>
                      </form>
                  <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materias com tipo telefonia -->
                  <?php
                  echo '<br>';
                  echo '<table  class="table table-hover">';
                  echo '<tr>';
                  echo '<th>Nome_modelo</th>';
                  echo '<th>Quantidade</th>';
                  echo '</tr>';

                  while ($registro = $sql->fetch()) {

                    $nome = $registro['fk_material'];
                    $qtd = $registro['sum(quantidade)'];

                    echo '<tr>';
                    echo '<td>' . $nome . '</td>';
                    echo '<td>' . $qtd . '</td>';
                    echo '</tr>';
                  }
                  echo '</table>';
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!----------------------------------- ESTOQUE GERAL --------------------------------------->
      <?php
    }
    if ($action == 'geral') {

      require_once 'conexao.php';
      $conn = new Conexao;
       
      $conn->conectar();

      $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao GROUP BY fk_material");
      $sql->execute();

      //Filtro nome e tipo selecionados
      if(isset($_POST['material'])){
         $material = $_POST['material'];
                 
          if(!empty($material)){
            $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao  where fk_material = :material GROUP BY fk_material");
            $sql->bindValue(":material",$material);
            $sql->execute();
  
          }

            else if(empty($material)){
              $sql = $pdo->prepare("SELECT fk_material, sum(quantidade) FROM alocacao GROUP BY fk_material");
              $sql->execute();
      
            }
           
        }
    
      ?>
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Estoque Geral</h5>
              <a href="index.php"> <img src="img/cancelar.png" /></a>
            </div>
            <div class="modal-body">
              <div class="container">
              <form class="form-row" method="POST">
                      <div class="row">
                        <div class="col-9">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Nome/Modelo">
                        </div> 
                        <div class="col-3">
                        <button type="submit" class="btn btn-success">Buscar</button>
                       </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                      </div>
                      <br>
                      </form>
                <!-- Faz uma conexão com o banco de dados, retorna uma lista com todos os materiais cadastrados -->
                <?php

                echo '<br>';
                echo '<table  class="table table-hover">';
                echo '<tr>';
                echo '<th>Nome_modelo</th>';
                echo '<th>Quantidade</th>';
                echo '</tr>';

                while ($registro = $sql->fetch()) {

                  $nome = $registro['fk_material'];
                  $qtd = $registro['sum(quantidade)'];

                  echo '<tr>';
                  echo '<td>' . $nome . '</td>';
                  echo '<td>' . $qtd . '</td>';
                  echo '</tr>';
                }
                echo '</table>';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
  //<!----------------------------------- EDITAR MATERIAL --------------------------------------->


  if ($action == 'editar') {

    require_once 'conexao.php';
    $conn = new Conexao;

    if(isset($_SESSION['msg'])){
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }


                $conn->conectar();
             
                //Filtro nome e tipo selecionados
                if(isset($_POST['material']) || isset($_POST['tipo']) || isset($_POST['filtro'])){
                $material = $_POST['material'];
                $tipo = $_POST['tipo'];
                $filtro = $_POST['filtro'];
                
                    if(!empty($material) && !empty($tipo)){
           
                    $sql = $pdo->prepare("SELECT id, nome_modelo, descricao, fk_tipo FROM material WHERE 
                    nome_modelo = :material AND fk_tipo = :tipo;");

                    $sql->bindValue(":material",$material);
                    $sql->bindValue(":tipo",$tipo);
                    $sql->execute();
                    }

                    else if(empty($material) && !empty($tipo)){
                  
                    $sql = $pdo->prepare("SELECT id, nome_modelo, descricao, fk_tipo FROM material WHERE fk_tipo = :tipo;");
                    $sql->bindValue(":tipo",$tipo);
                    $sql->execute();
                    }
                    
                        else if(!empty($material) && empty($tipo)){
                      
                        $sql = $pdo->prepare("SELECT id, nome_modelo, descricao, fk_tipo FROM material WHERE nome_modelo = :material;");
                        $sql->bindValue(":material",$material);
                        $sql->execute();
                        
                        } 
                        else if(empty($material) && empty($tipo) && !empty($filtro)){
                          $sql = $pdo->prepare("SELECT id, nome_modelo, descricao, fk_tipo FROM material ORDER BY id DESC;");
                          $sql->execute();
                        
                        }
               

                }
                // Sem Filtros

               if(!isset($_POST['material']) && !isset($_POST['tipo'])){
                $sql = $pdo->prepare("SELECT id, nome_modelo, descricao, fk_tipo FROM material ORDER BY id DESC;");
                $sql->execute();
              
              }

              
    ?>
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Materiais</h5>
            <a href="index.php"> <img src="img/cancelar.png" /></a>
          </div>
          <div class="modal-body">
            <div class="container">              
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                      <form class="form-row" method="POST">
                      <div class="row">
                        <div class="col-3">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Pesquisar por nome">
                        </div> 
                        <div class="col-3">
                        <select class="form-control" id="tipo" name="tipo">
                          <option value="" selected>Selecione o tipo</option>
                          <option value="Hardware">Hardware</option>
                          <option value="Impressao">Impressão</option>
                          <option value="Telefonia">Telefonia</option>
                       </select>
                        </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                        <div class="col-2">
                        <button type="submit" class="btn btn-success">Buscar</button>
                       </div>
                      </div>
                      <br>
                      </form>
                        <tr>
                          <th>Nome do material</th>
                          <th>Descrição</th>
                          <th>Tipo</th>
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($rows = $sql->fetch()) { ?>
                          <tr>
                            <td><?php echo $rows['nome_modelo']; ?></td>
                            <td><?php echo $rows['descricao']; ?></td>
                            <td><?php echo $rows['fk_tipo']; ?></td>

                            <td>
                              <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal" 
                              data-whatever="<?php echo $rows['id']; ?>" data-whatevernome="<?php echo $rows['nome_modelo']; ?>" 
                              data-whateverdescri="<?php echo $rows['descricao']; ?>" data-whatevertipo="<?php echo $rows['fk_tipo'];                                                                                                                                                                                                                                                                                    ?>">Editar</button>

                              <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" 
                              data-target="#myModal<?php echo $rows['id']; ?>">Excluir</button>

                            </td>
                          </tr>
                          <!-- Inicio Modal de teste-->
                          <div class="modal fade" id="myModal<?php echo $rows['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                <h4> Excluir Materiais </h4>
                                <a href="index.php?pagina=home&action=editar"><img src="img/cancelar.png" /></a>                        
                                </div>
                                <div class="modal-body">
                                  <h5>Tem certeza que deseja excluir o material "<?php echo $rows['nome_modelo']; ?>"</h5>
                                </div>
                                <div class="modal-footer">
                                <a href="excluirMaterial.php?id=<?= $rows['id'] ?>" type="submit" class="btn btn-xs btn-danger" style="color:white;">Excluir</a>
                                <button type="button" class="btn btn-success" data-dismiss="modal">Não, voltar</button>                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>


            <!-- Modal Editar Materiais -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4>Editar material</h4>
                    <a href="index.php?pagina=home&action=editar"><img src="img/cancelar.png" /></a>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="EditarMaterial.php">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Nome_modelo:</label>
                        <input name="nome" type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="control-label">Descrição:</label>
                        <input name="descri" class="form-control" id="descri">
                      </div>
                      <div class="form-group">
                        <label for="inputModelo" class="control-label">Tipo:</label>
                        <select id="inputModelo" class="form-control" name="tipo">
                          <option selected></option>
                          <!-- Faz uma conexão com o banco de dados, retorna uma consulta com o tipo de material -->

                          <div class="tabela">
                            <?php
                            $sql = $pdo->prepare("SELECT * FROM tipo_material");
                            $sql->execute();

                            while ($registro = $sql->fetch()) {
                              $tipo = $registro['tipo'];
                              ?>
                              <option value="<?php echo "$tipo"; ?>"> <?php echo "$tipo"; ?> </option>
                            <?php
                          } ?>
                        </select>
                      </div>
                      <input name="id" type="hidden" class="form-control" id="id" value="<?php echo $rows['id']; ?>">
                      <button type="submit" class="btn btn-success">Salvar alterações</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script type="text/javascript">
              $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                var recipientnome = button.data('whatevernome')
                var recipientdescri = button.data('whateverdescri')
                var recipienttipo = button.data('whatevertipo')

                var modal = $(this)
                modal.find('#id').val(recipient)
                modal.find('#recipient-name').val(recipientnome)
                modal.find('#descri').val(recipientdescri)
                modal.find('#tipo').val(recipienttipo)

              })
            </script>
   <?php    
        }

        //<!----------------------------------- Lista de empréstimo --------------------------------------->
        if ($action == 'listaEmprestimo') {

          require_once 'conexao.php';
        
          $conn = new Conexao;
          $conn->conectar();
          $dataAtual =  date('Y-m-d');

          $sql = $pdo->prepare("UPDATE emprestimo SET prazo_emprestimo = :situacao WHERE data_fim >= :dataAtual
          AND prazo_emprestimo <> Finalizado dentro do prazo");
          $sql->bindValue(":situacao", 'Dentro do prazo');
          $sql->bindValue(":dataAtual", $dataAtual);
          $sql->execute();

          $sql = $pdo->prepare("UPDATE emprestimo SET prazo_emprestimo = :situacao WHERE data_fim < :dataAtual
           AND prazo_emprestimo <> Finalizado dentro do prazo");
          $sql->bindValue(":situacao",'Fora do prazo');
          $sql->bindValue(":dataAtual", $dataAtual);
          $sql->execute();


          ?>
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Lista de Empréstimos</h5>
                  <a href="?" class="close" data-dismiss="modal"> <img src="img/cancelar.png" /></a>
                  </a>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form class="form-row" method="POST" action="">
                      <div class="row">
                        <div class="col-2">
                          <input type="text" class="form-control" name="material" id="material" placeholder="Filtrar por nome">
                        </div> 
                        <div class="col-3">
                          <input type="text" class="form-control" name="serviceTag" id="serviceTag" placeholder="Filtrar por ServiceTag">
                        </div> 
                        <div class="col-3">
                          <input type="text" class="form-control" name="usuario" id="Usuario" placeholder="Filtrar por Usuário">
                        </div> 
                        <div class="col-2">
                        <select class="form-control" id="prazo" name="prazo">
                          <option value="" selected>Status do prazo</option>
                          <option value="Dentro do prazo">Dentro do prazo</option>
                          <option value="Fora do prazo">Fora do prazo</option>
                          <option value="Finalizado fora do prazo">Finalizado fora do prazo</option>
                          <option value="Finalizado dentro do prazo">Finalizado dentro do prazo</option>
                       </select>
                        </div>
                        <input type="hidden" value="1" id="filtro" name="filtro">
                        <div class="col-1">
                          <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                      </div>
                      <br>
                      </form>
                      <br>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <!-- Faz uma conexão com o banco de dados, retorna uma lista de equipamentos e seus status -->
                          <div>
                            <?php
                           
                            $sql = $pdo->prepare("SELECT * FROM emprestimo ORDER BY id desc");
                            $sql->execute();
                            echo "inicio";
                            
       ########################################### FILTROS ###############################################


             

                            echo '<table  class="table table-hover">';
                            echo '<tr>';
                            echo '<td><b>Nome_modelo</td>';
                            echo '<td><b>Service_tag/IMEI</td>';
                            echo '<td><b>Usuário</td>';
                            echo '<td><b>Email</td>';
                            echo '<td><b>Prazo de empréstimo</td>';
                           // echo '<td><b>Data de início</td>';
                            echo '<td><b>Data do fim</td>';

                            echo '</tr>';

                            while ($registro = $sql->fetch()) {

                              $nome = $registro['nome_modelo'];
                              $codigo = $registro['fk_codigo'];
                              $usuario = $registro['usuario'];
                              $email = $registro['email'];
                              $prazo = $registro['prazo_emprestimo'];
                             // $dataInicio = $registro['data_inicio'];
                              $dataFim = $registro['data_fim'];

                              echo '<tr>';
                              echo '<td>' . $nome . '</td>';
                              echo '<td>' . $codigo . '</td>';
                              echo '<td>' . $usuario . '</td>';
                              echo '<td>' . $email . '</td>';
                              echo '<td>' . $prazo . '</td>';
                              //echo '<td>' .  date('d/m/Y', strtotime($dataInicio)) . '</td>';
                              echo '<td>' .  date('d/m/Y', strtotime($dataFim)) . '</td>';
                              echo '</tr>';
                            }
                            echo '</table>';
                            ?>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

              <?php
            }
