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
      <!-- CARROSSEL DE IMAGENS -->
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="item active">
            <img src="img/img1.jpg" alt="Los Angeles" style="width:100%;">
          </div>
          <div class="item">
            <img src="img/img2.jpg" alt="Chicago" style="width:100%;">
          </div>
          <div class="item">
            <img src="img/img3.jpg" alt="New york" style="width:100%;">
          </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only"></span>
        </a>
      </div>
        <!-- NAVBAR -->
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
              <li class="active"><a href="index.php">Home</a></li>
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
              <li><a href="contato.php">Contato</a></li>
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
      <?php
        if(isset($_POST['deslogar'])){
          unset($_SESSION['privateUser']);
          header("location:index.php");
      } else {
      ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-3 text-center">
            <h3>Facilidade</h3>
            <p>Nosso projeto oferece</p>
            <p>facilidade para o usuário</p>
            <p>interagir com o sistema.</p>
          </div>
          <div class="col-sm-6 text-center">
            <h3>Segurança</h3>
            <p>Prezamos a segurança</p>
            <p>do usuário, cripitografando</p>
            <p>todos os seus dados.</p>
          </div>
          <div class="col-sm-3 text-center">
            <h3>Design</h3>
            <p>Oferecemos o design</p>
            <p>do jeito que o cliente</p>
            <p>desejar</p>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </body>
</html>
