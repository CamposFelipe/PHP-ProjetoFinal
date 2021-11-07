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
    <title>Alterar Produto</title>
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
       include 'modelo/produto.class.php';
       include 'dao/produtodao.class.php';

       if(isset($_GET['id'])){
         $pDAO = new ProdutoDAO();
         $query = "where idprod = ".$_GET['id'];
         $array = $pDAO->filtrarProduto($query);
         //para testar
         unset($_GET['id']);
       }
       ?>

    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Alterar Produto</h1>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-xs-4">
        <form name="alterarpessoa" method="post" action="">
          <div class="form-group col-xs-12">
            <input name="txtcodigo" class="form-control" type="number" readonly="readonly" required="required" value="<?php if(isset($array))echo $array[0]->idProd?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtnome" class="form-control" type="text" required="required" pattern="^[a-zA-ZÀ-ú ]{2,30}$" value="<?php if(isset($array))echo $array[0]->nomeProd?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtvalor" class="form-control" type="number" required="required" pattern="^[0-9]{2,500}$" value="<?php if(isset($array))echo $array[0]->valorProd?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtmarca" class="form-control" type="text" required="required" pattern="^[a-zA-ZÀ-ú ]{2,30}$" value="<?php if(isset($array))echo $array[0]->marcaProd?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtclasse" class="form-control" type="text" required="required" pattern="^[a-zA-ZÀ-ú ]{2,30}$" value="<?php if(isset($array))echo $array[0]->classeProd?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtquantestoque" class="form-control" type="number" required="required" pattern="^[0-9]{2,500}$" value="<?php if(isset($array))echo $array[0]->quantEstoque?>">
          </div>
         <div class="form-group">
           <input type="submit" name="alterar" value="Alterar" class="btn btn-primary">
           <input type="reset" name="limpar" value="Limpar" class="btn btn-danger">
         </div>
       </form>
       <?php
       if(isset($_POST['alterar'])){
         include 'util/padronizacao.class.php';

         //padronizacao
         $idProd = $_POST['txtcodigo'];
         $nomeProd = Padronizacao::padronizarMaiMin($_POST['txtnome']);
         $valorProd = $_POST['txtvalor'];
         $marcaProd = Padronizacao::padronizarMaiMin($_POST['txtmarca']);
         $classeProd = Padronizacao::padronizarMaiMin($_POST['txtclasse']);
         $quantEstoque = $_POST['txtquantestoque'];

         $p = new Produto();
         $p->idProd = $idProd;
         $p->nomeProd = $nomeProd;
         $p->valorProd = $valorProd;
         $p->marcaProd = $marcaProd;
         $p->classeProd = $classeProd;
         $p->quantEstoque = $quantEstoque;

         $pDAO = new ProdutoDAO();
         $pDAO->alterarProduto($p);

        header("location:buscar-produto.php");
       }//fecha if
       ?>
     </div>
   </body>
</html>
