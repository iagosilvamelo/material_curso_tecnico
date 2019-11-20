<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once ('config.php');
require_once ('vendor/autoload.php');
include_once ('db.php');
include_once ('marcas.class.php');

//conecta ao banco
$database = new Database();
$db = $database->conect();
$carros=new Automovel($db);
$marcas=$carros->readAll();

echo $twig->render('listagem.twig', array('marcas' => $marcas));

?>
