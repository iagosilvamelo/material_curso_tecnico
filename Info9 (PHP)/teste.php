<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

include_once('db.php');
include_once('marcas.class.php');

$database = new Database();
$db = $database->conect();
$carros=new Automovel($db);
$marcas=$carros->readAll();

$id = 10;

foreach ($marcas as $m) {
        echo '<p>Id = '.$m['id']. ' : Nome = '.$m['Nome'].'</p>';
}

$m = $carros->readOne($id);
print_r($m);

$m = $carros->delete($id);
if ($m != 0){
    echo '<p>Registro '.$id. ' deletado com sucesso.</p>';
    $marcas=$carros->readAll();

    foreach ($marcas as $m) {
            echo '<p>Id = '.$m['id']. ' : Nome = '.$m['Nome'].'</p>';
    }
} else echo '<p>Nehum registro deletado.</p>';


$nome = 'Charrete';
$origem = 'Rio Grande do Sul';
$presidente = 'Jose Ivo Sartori';
$fundacao = 2016;
$m = 0; // $m = $carros->insert($nome, $origem, $presidente, $fundacao);
if ($m != 0){
    echo $m. ' registros gravados';
    $marcas=$carros->readAll();
    foreach ($marcas as $m) {
            echo '<p>Id = '.$m['id']. ' : Nome = '.$m['Nome'].'</p>';
    }
} else echo '<p>Nehum registro gravado.</p>';

$id = 16;
$nome = 'Chevette';
$origem = 'Brasil';
$presidente = 'Alguem';
$fundacao = 2016;
$m = $carros->update($id, $nome, $origem, $presidente, $fundacao);
if ($m != 0){
    echo $m. ' registros alterados';
    $marcas=$carros->readAll();
    foreach ($marcas as $m) {
            echo '<p>Id = '.$m['id']. ' : Nome = '.$m['Nome'].'</p>';
    }
} else echo '<p>Nehum registro alterado.</p>';

?>

