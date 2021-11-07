<?php
include 'dao/funcionariodao.class.php';
include 'modelo/funcionario.class.php';

$fDAO = new FuncionarioDAO();
echo $fDAO->gerarJSONFuncionario();
?>
