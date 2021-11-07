<?php session_start(); ob_start();?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>LojaInfo</title>
  </head>
  <body>
    <div id="div_principal">
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
              <li class="active"><a href="contato.php">Contato</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <form name="deslogar" action="" method="post">
                <input type="submit" class="btn btn-danger" name="deslogar" value="Deslogar">
              </form>
            </ul>
          </div>
        <?php
        }else if($u->tipo == 'Usuario'){
        ?>
          <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">LojaInfo</a>
            </div>
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="filtrar-produto.php">Produtos</a></li>
              <li class="active"><a href="contato.php">Contato</a></li>
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
              <li><a href="index.php">Home</a></li>
              <li><a href="filtrar-produto.php">Produtos</a></li>
              <li class="active"><a href="contato.php">Contato</a></li>
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
      <?php
        if(isset($_POST['deslogar'])){
          unset($_SESSION['privateUser']);
          header("location:index.php");
      } else {
      ?>
      <div class="page-header">
        <h1 class="text-center">Contato</h1>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-sm-3 text-center">
            <h3>Loja Info:</h3>
            <p>Email:Loja@info.com.br</p>
            <p>Telefone:(51) 4545-3028</p>
            <p>whatsapp:(51) 99595-3828</p>
            <p>Facebook:/LojaInfo</p>
          </div>
          <div class="col-sm-6 text-center">
            <h3>Felipe Campos</h3>
            <p>Email:felipecampos395@hotmail.com</p>
            <p>Whatsapp:(51) 98592-6408</p>
          </div>
          <div class="col-sm-3 text-center">
            <h3>Thiago Fortes</h3>
            <p>Email:thiago112fortes@hotmail.com</p>
            <p>Whatsapp:(51) 98311-9167</p>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </body>
</html>
