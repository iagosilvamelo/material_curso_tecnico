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

    if (!empty($_GET['id'])){
		$id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
        $marcas = $carros->readOne($id);
        echo $twig->render('confirma.twig', array('marcas' => $marcas));
	} else {
		header('location:listagem.php');
	}
	
	if ( !empty($_POST) ){
		# recebe as variáveis do formulário
		$id = $_POST['id'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($id)){
			$error .= 'O id não pode estar vazio.';
		}
		# filtra caracteres não-permitidos
		$id = strip_tags(filter_var($id, FILTER_VALIDATE_INT));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$id){
			$error .= 'O id tem caracteres não permitidos.';
		}
		require_once('db.php');
		# tenta inserir
		try {
			# se $error não estiver vazia,
			# gera exceção e não executa delete
			if (!empty($error)){
				throw new Exception($e);
			}
            $m = $carros->delete($id);
		} catch (PDOException $err){
			# entra aqui se houver exceção PDO
			$error .= $err->getMessage();
		} catch (Exception $e){
			# entra aqui se houver exceção geral
			$error .= $e->getMessage();
		} finally {
			# finally SEMPRE é executado
			if (!empty($error)){
				$msg = '<p class="alert alert-danger" >Problemas na deleção. '.$error.'</p>';
			} else {
				$msg = '<p class="alert alert-success" >Deletado com sucesso!</p>';
			}
			header('location:listagem.php?mens='.$msg);
		}
	}	
?>
