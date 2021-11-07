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
    <title>Consulta de Produtos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div>
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
      include 'dao/produtodao.class.php';
      include 'modelo/produto.class.php';

      $pDAO = new ProdutoDAO();
      $array = $pDAO->buscarProduto();

      if(count($array) != 0){
      ?>
      <div class="table-responsive container">
        <div class="page-header">
          <h1 class="text-center">Produtos</h1>
        </div>
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>Alterar</th>
              <th>Excluir</th>
              <th>Código</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Marca</th>
              <th>Classe</th>
              <th>Quantidade em Estoque</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Alterar</th>
              <th>Excluir</th>
              <th>Código</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Marca</th>
              <th>Classe</th>
              <th>Quantidade em Estoque</th>
            </tr>
          </tfoot>

          <tbody>
            <?php
            foreach($array as $a){
              echo "<tr>";
                echo "<td><a href='alterar-produto.php?id=$a->idProd'><img src='img/alterar.png' width=25px; alt='Alterar'/></a></td>";
                echo "<td><a href='buscar-produto.php?id=$a->idProd'><img src='img/x.png' width=25px; alt='Excluir'/></a></td>";
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
      } else {
        echo "Não há produto(s) para ser(em) exibido(s)!";
      }
      if(isset($_GET['id'])){
       $pDAO = new ProdutoDAO();
       $pDAO->deletarProduto($_GET['id']);
       header("location:buscar-produto.php");
      }
      ?>
    </div>
  </body>
</html>
