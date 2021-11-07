<?php
session_start();
ob_start();

if(isset($_SESSION['privateUser'])){
  include_once 'modelo/usuario.class.php';
  $u = unserialize($_SESSION['privateUser']);
  if($u->tipo == 'Adm' || $u->tipo == 'Usuario'){
    header("location:index.php");
  }
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
    <title>Login</title>
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
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="filtrar-produto.php">Produtos</a></li>
            <li><a href="#">Clientes</a></li>
            <li><a href="#">Funcionários</a></li>
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
    if(isset($_SESSION['privateUser'])){

      include_once 'modelo/usuario.class.php';
      $u = unserialize($_SESSION['privateUser']);
      echo "<h2>Olá $u->login, seja bem vindo</h2>";
      ?>
    <?php
      if(isset($_POST['deslogar'])){
        unset($_SESSION['privateUser']);
        header("location:index.php");
      }
    } else {
    ?>
    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Login</h1>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-xs-4">
        <form name="cadusuario" method="post" action="" class="form">
          <div class="form-group col-xs-12">
            <input name="txtlogin" class="form-control" type="text" placeholder="Login" required="required">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtsenha" class="form-control" type="password" placeholder="Senha" required="required">
          </div>
          <div class="form-group col-xs-12">
            <select name="seltipo" class="form-control">
              <option value="Usuario">Cliente</option>
              <option value="Adm">Funcionário</option>
            </select>
          </div>
          <div class="form-group col-xs-12">
            <input type="submit" name="entrar" value="Entrar" class="btn btn-primary">
          </div>
        </form>
      </div>
      <?php
      }//fecha

      if(isset($_POST['entrar'])){

        include_once 'modelo/usuario.class.php';
        include 'dao/usuariodao.class.php';
        include 'util/seguranca.class.php';

        //padronizacao
        $login = $_POST['txtlogin'];
        $senha = Seguranca::criptografar($_POST['txtsenha']);
        $tipo = $_POST['seltipo'];

        //validacao
        $u = new Usuario();
        $u->login = $login;
        $u->senha = $senha;
        $u->tipo = $tipo;

        //teste
        //var_dump($u);

        //DAO
        $uDAO = new UsuarioDAO();
        $usuario = $uDAO->verificarUsuario($u);

        if($usuario && !is_null($usuario)){
          //Significa que login tá certo!
          var_dump($usuario);
          $_SESSION['privateUser'] = serialize($usuario);
          header("location:index.php");
        }else{
          //Não existe usuário no banco
          echo "Usuario/Senha Inválido(s)!";
        }

        unset($_POST['entrar']);
      }//fecha if
      ?>
    </div>
  </body>
</html>
