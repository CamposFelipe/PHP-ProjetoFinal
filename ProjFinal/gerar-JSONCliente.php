<?php
include 'dao/clientedao.class.php';
include 'modelo/cliente.class.php';

$cDAO = new ClienteDAO();
echo $cDAO->gerarJSONCliente();
?>
