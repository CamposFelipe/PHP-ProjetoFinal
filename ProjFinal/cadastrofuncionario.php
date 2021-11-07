<?php
session_start();
ob_start();

if(isset($_SESSION['privateUser'])){
  include_once 'modelo/usuario.class.php';
  $u = unserialize($_SESSION['privateUser']);
  if($u->tipo != 'Adm'){
    header("location:index.php");
  }
}else{
  header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Cadastrar Funcionário</title>
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
            <li class="dropdown">
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
            <li class="dropdown active">
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="filtrar-produto.php">Produtos</a></li>
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
      }else{
      ?>
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">LojaInfo</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="filtrar-produto.php">Produtos</a></li>
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
        <h1 class="text-center">Cadastrar Funcionário</h1>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-xs-4">
        <form name="cadusuario" method="post" action="" class="form">
          <div class="form-group col-xs-12">
            <input name="txtnome" class="form-control" type="text" placeholder="Nome" required="required" pattern="^[a-zA-ZÀ-ú ]{2,30}$">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtcargo" class="form-control" type="text" placeholder="Cargo" required="required" pattern="^[a-zA-ZÀ-ú ]{2,30}$">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtvendas" class="form-control" type="number" placeholder="Vendas" required="required" pattern="^[0-9]{2,5000}$">
          </div>
          <div class="form-group col-xs-12">
            <input name="txttel" class="form-control" type="number" placeholder="Telefone" required="required" pattern="^[0-9]{9,20}$">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtsalario" class="form-control" type="text" placeholder="Salario" required="required" pattern="^[0-9]{2,5000}$">
          </div>
          <div class="form-group col-xs-12">
            <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary">
            <input type="reset" name="Limpar" value="Limpar" class="btn btn-danger">
          </div>
        </form>
      </div>
    </div>

        <?php
        if(isset($_POST['cadastrar'])){
          include 'modelo/funcionario.class.php';
          include_once 'dao/funcionariodao.class.php';
          include 'util/padronizacao.class.php';

          $nome = Padronizacao::padronizarMaiMin($_POST['txtnome']);
          $cargo = Padronizacao::padronizarMaiMin($_POST['txtcargo']);
          $vendas = $_POST['txtvendas'];
          $telefone = $_POST['txttel'];
          $salario = $_POST['txtsalario'];

          $f = new Funcionario();
          $f->nome = $nome;
          $f->cargo = $cargo;
          $f->vendas = $vendas;
          $f->telefone = $telefone;
          $f->salario = $salario;

          $fDAO = new FuncionarioDAO();
          $fDAO->cadastrarFuncionario($f);

          header('location:buscar-funcionario.php');
        }
        ?>
        </div>
      </div>
    </div>
  </body>
</html>
