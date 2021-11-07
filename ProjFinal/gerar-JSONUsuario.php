<?php
include 'dao/usuariodao.class.php';
include 'modelo/usuario.class.php';

$uDAO = new UsuarioDAO();
echo $uDAO->gerarJSONUsuario();
?>
