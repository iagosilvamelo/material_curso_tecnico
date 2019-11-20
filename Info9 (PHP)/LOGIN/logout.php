<?php
session_start(); // Inicializa o controle de sessões do PHP
error_reporting(E_ALL);
ini_set('display_errors','on');

session_destroy();
$msg='<p class="alert alert-success" >Volte sempre!</p>';
header("location: login.php?retorno=$msg");
?>
