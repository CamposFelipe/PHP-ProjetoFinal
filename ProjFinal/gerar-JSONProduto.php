<?php
include 'dao/produtodao.class.php';
include 'modelo/produto.class.php';

$pDAO = new ProdutoDAO();
echo $pDAO->gerarJSONProduto();
?>
