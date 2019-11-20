<?php
//importa as classes
include_once('db.php');
include_once('marcas.class.php');

//conecta ao banco
$database = new Database();
$db = database->conect();

$carros = new Automovel($db);
$marcas = $carros->readAll();

foreach ($marcas as $m) {
    echo '<p> Nome '.$m['Nome'].'</p>';
}
?>

