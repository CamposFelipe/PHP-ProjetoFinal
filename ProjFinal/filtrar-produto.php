<?php session_start(); ob_start();?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Filtrar Produto</title>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <?php
      if(isset($_SESSION['privateUser'])){
        include_once 'modelo/usuario.class.php';
        $u = unserialize($_SESSION['privateUser']);
        if($u->tipo == 'Adm'){
      ?>
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">LojaInfo</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown active">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Produtos <span class="caret"></span></a>
              <ul class="dropdown-menu nav" role="menu">
                <li><a href="cadastro-produto.php">Cadastrar</a></li>
                <li><a href="filtrar-produto.php">Filtrar</a></li>
                <li><a href="buscar-produto.php">Buscar</a></li>
                <li><a href="gerar-JSONProduto.php" target="_blank">JSON</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Cliente <span class="caret"></span></a>
              <ul class="dropdown-menu nav" role="menu">
                <li><a href="cadastrocliente.php">Cadastrar</a></li>
                <li><a href="filtrar-cliente.php">Filtrar</a></li>
                <li><a href="buscar-cliente.php">Buscar</a></li>
                <li><a href="gerar-JSONCliente.php" target="_blank">JSON</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Funcionários <span class="caret"></span></a>
              <ul class="dropdown-menu nav" role="menu">
                <li><a href="cadastrofuncionario.php">Cadastrar</a></li>
                <li><a href="filtrar-funcionario.php">Filtrar</a></li>
                <li><a href="buscar-funcionario.php">Buscar</a></li>
                <li><a href="gerar-JSONProduto.php" target="_blank">JSON</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Usuários <span class="caret"></span></a>
              <ul class="dropdown-menu nav" role="menu">
                <li><a href="cadastroadmusuarios.php">Cadastrar</a></li>
                <li><a href="gerar-JSONUsuario.php" target="_blank">JSON</a></li>
              </ul>
            </li>
            <li><a href="contato.php">Contato</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <form name="deslogar" action="" method="post">
              <input type="submit" class="btn btn-danger" name="deslogar" value="Deslogar">
            </form>
          </ul>
        </div>
      <?php
      if(isset($_POST['deslogar'])){
        unset($_SESSION['privateUser']);
        header("location:index.php");
      }
      }else if($u->tipo == 'Usuario'){
      ?>
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">LojaInfo</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="filtrar-produto.php">Produtos</a></li>
            <li><a href="contato.php">Contato</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <form name="deslogar" action="" method="post">
              <input type="submit" class="btn btn-danger" name="deslogar" value="Deslogar">
            </form>
          </ul>
        </div>
      <?php
        }
        if(isset($_POST['deslogar'])){
          unset($_SESSION['privateUser']);
          header("location:index.php");
        }
      }else{
      ?>
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">LojaInfo</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="filtrar-produto.php">Produtos</a></li>
            <li><a href="contato.php">Contato</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="cadastrousuario.php"><span class="glyphicon glyphicon-user"></span> Cadastrar-se</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      <?php
      }
      ?>
    </nav>
    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Filtrar Produto</h1>
      </div>
      <form name="filtrarproduto" method="post" action="">
        <div class="form-group">
          <input type="text" name="txtpesquisa" placeholder="Digite a sua pesquisa" class="form-control">
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="idProd">Código</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="nomeProd">Nome</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="valorProd">Valor</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="marcaProd">Marca</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="classeProd">Classe</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" value="quantEstoque">Quantidade em Estoque</label>
        </div>
        <div class="radio-inline">
          <label class="radio-inline"><input type="radio" name="rdfiltro" checked="checked" value="todos">Todos</label>
        </div>
        <div class="form-group">
          <input type="submit" name="filtrar" value="filtrar" class="btn btn-primary" class="form-control">
        </div>
      </form>
    </div>

    <?php
    include 'dao/produtodao.class.php';
    include 'modelo/produto.class.php';

    if(isset($_POST['filtrar'])){

      $filtro = $_POST['rdfiltro'];
      $pesq = $_POST['txtpesquisa'];
      $query ="";

      if($pesq != ""){
        if($filtro == 'idProd'){
          $query = "where idProd = ".$pesq;
        }else if($filtro == 'nomeProd'){
          $query = "where nomeProd like '%".$pesq."%'";
        }else if($filtro == 'valorProd'){
          $query = "where valorProd like '%".$pesq."%'";
        }else if($filtro == 'marcaProd'){
          $query = "where marcaProd like '%".$pesq."%'";
        }else if($filtro == 'classeProd'){
          $query = "where classeProd like '%".$pesq."%'";
        }else if($filtro == 'quantEstoque'){
          $query = "where quantEstoque like '%".$pesq."%'";
        }
      }

    $pDAO = new ProdutoDAO();
    $array = $pDAO->filtrarProduto($query);

    }else{
      $pDAO = new ProdutoDAO();
      $array = $pDAO->buscarProduto();
    }

    if(count($array) !=0){
    ?>
    <div class="table-responsive container">
      <table class="table table-striped table-bordered table-hover table-condensed">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Marca</th>
            <th>Classe</th>
            <th>Quantidade em Estoque</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Marca</th>
            <th>Classe</th>
            <th>Quantidade em Estoque</th>
          </tr>
        </tfoot>

        <tbody>
          <?php
          foreach($array as $a){
            echo "<tr>";
              echo "<td>$a->idProd</td>";
              echo "<td>$a->nomeProd</td>";
              echo "<td>$a->valorProd</td>";
              echo "<td>$a->marcaProd</td>";
              echo "<td>$a->classeProd</td>";
              echo "<td>$a->quantEstoque</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
    }else{
      echo "<h2>Não há dado(s) para ser(em) exibido(s)!</h2>";
    }//fecha else
    unset($array);
    ?>
  </div>
</body>
</html>
