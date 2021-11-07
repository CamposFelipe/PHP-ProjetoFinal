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
    <title>Alterar Cliente</title>
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
            <li class="dropdown active">
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
       include 'modelo/cliente.class.php';
       include 'dao/clientedao.class.php';

       if(isset($_GET['id'])){
         $pDAO = new ClienteDAO();
         $query = "where idCliente = ".$_GET['id'];
         $array = $pDAO->filtrarCliente($query);
         //para testar
         unset($_GET['id']);
       }
       ?>
    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Alterar Cliente</h1>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-xs-4">
        <form name="alterarcliente" method="post" action="">
          <div class="form-group col-xs-12">
            <input name="txtcodigo" class="form-control" type="number" readonly="readonly" required="required" value="<?php if(isset($array))echo $array[0]->idCliente?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtnomecompleto" class="form-control" type="text" required="required" value="<?php if(isset($array))echo $array[0]->nomeCompleto?>">
          </div>
          <div class="form-group col-xs-12">
          <label><input type="radio" name="rdsexo" value="Masculino" class="checkbox-inline"
            <?php
            if(isset($array)){
              if($array[0]->sexo == 'Masculino'){
                echo "checked='checked'";
              }
            }
            ?>>Masculino</label>
          <label><input type="radio" name="rdsexo" value="Feminino" class="checkbox-inline"
            <?php
            if(isset($array)){
              if($array[0]->sexo == 'Feminino'){
                echo "checked='checked'";
              }
            }
            ?>>Feminino</label>
         </div>
          <div class="form-group col-xs-12">
            <input name="txtdatanasc" class="form-control" type="date" required="required" value="<?php if(isset($array))echo $array[0]->dataNasc?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txttelefone" class="form-control" type="number" required="required" value="<?php if(isset($array))echo $array[0]->telefone?>">
          </div>
          <div class="form-group col-xs-12">
            <input name="txtendereco" class="form-control" type="text" required="required" value="<?php if(isset($array))echo $array[0]->endereco?>">
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
         $idCliente = $_POST['txtcodigo'];
         $nomeCompleto = Padronizacao::padronizarMaiMin($_POST['txtnomecompleto']);
         $sexo = Padronizacao::padronizarMaiMin($_POST['rdsexo']);
         $dataNasc = $_POST['txtdatanasc'];
         $telefone = $_POST['txttelefone'];
         $endereco = Padronizacao::padronizarMaiMin($_POST['txtendereco']);

         $c = new Cliente();
         $c->idCliente = $idCliente;
         $c->nomeCompleto = $nomeCompleto;
         $c->sexo = $sexo;
         $c->dataNasc = $dataNasc;
         $c->telefone = $telefone;
         $c->endereco = $endereco;

         $cDAO = new ClienteDAO();
         $cDAO->alterarCliente($c);

        header("location:buscar-cliente.php");
       }//fecha if
       ?>
     </div>
   </body>
</html>
