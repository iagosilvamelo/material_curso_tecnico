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
//$marcas=$carros->update($id, $nome, $origem, $presidente, $fundacao);
//

if (!empty($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
    $marcas = $carros->readOne($id);
    $dados = array('marcas' => $marcas);
    echo $twig->render('altera.twig', $dados);

}

if (!empty($_POST)){ 
        # recebe as variáveis do formulário
		$nome = $_POST['nome'];
		$origem = $_POST['origem'];
		$presidente = $_POST['presidente'];
        $fundacao = $_POST['fundacao'];
		$id = $_POST['id'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($nome)){
			$error .= 'O nome não pode estar vazio.';
		}
		if (empty($origem)){
			$error .= 'A origem não pode estar vazia.';
		}
		if (empty($presidente)){
			$error .= 'O presidente não pode estar vazio.';
		}
        if (empty($fundacao)){
			$error .= 'A fundacao não pode estar vazia.';
		}
		# filtra caracteres não-permitidos
		$nome = strip_tags(filter_var($nome));
		$origem = strip_tags(filter_var($origem));
		$presidente = strip_tags(filter_var($presidente));
		$fundacao = strip_tags(filter_var($fundacao));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$nome){
			$error .= 'O nome tem caracteres não permitidos.';
		}
		if (!$origem){
			$error .= 'A origem tem caracteres não permitidos.';
		}
		if (!$presidente){
			$error .= 'O presidente não é válido.';
		}
        if (!$fundacao){
			$error .= 'A fundacao tem caracteres não permitidos.';
		}
		
		require_once('db.php');
		# tenta inserir
		try {
			# se $error não estiver vazia,
			# gera exceção e não executa insert
			if (!empty($error)){
				throw new Exception($e);
			}
            
			$m = $carros->update($id, $nome, $origem, $presidente, $fundacao);
            

		} catch (PDOException $err){
			# entra aqui se houver exceção PDO
			$error .= $err->getMessage();
		} catch (Exception $e){
			# entra aqui se houver exceção geral
			$error .= $e->getMessage();
		} finally {
			# finally SEMPRE é executado
			if (!($m) || !empty($error)){
				$msg = '<p class="alert alert-danger" >Problemas na alteração. '.$error.'</p>';
			} else {
				$msg = '<p class="alert alert-success" >Alterado com sucesso!</p>';
			}
			header('location:listagem.php?mens='.$msg);
		}
}
?>
