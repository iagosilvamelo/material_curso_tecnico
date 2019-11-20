<?php

// Configurando o anúncio (report) de erros (php.ini)
error_reporting(E_ALL);		// prod: E_INFO
ini_set('display_errors', 'on');  // prod: off
date_default_timezone_set('America/Sao_Paulo');

require_once('email.func.php');
$titulo = 'Esqueci senha';
$cabecalho = 'Esqueci minha senha';

	if ( !empty($_POST) ){
		# recebe as variáveis do formulário
		$email = $_POST['email'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($email)){
			$error .= 'O email não pode estar vazio.';
		}
		# filtra caracteres não-permitidos
		$email = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$email){
			$error .= 'O email não é válido.';
		}
		$hashopt = [
			'cost' => 5 // default = 10
		];
		$ehash = password_hash($email, PASSWORD_DEFAULT,$hashopt);
		# Para ficar profissional, precisa verificar 
		# a data de expiracão do hash
		#
		# usuário não pode estar ativo se não confirmou o email
		//$ativo = false;
		//$senha = '';
		# tenta encontrar o email na base de dados
		require_once('bd.php');
		try {
			# se $error não estiver vazia,
			# gera exceção e não executa insert
			if (!empty($error)){
				throw new Exception($e);
			}
			$sql = 'SELECT nome,email 
					FROM usuarios 
					WHERE email = ?';
			$seleciona = $conexao->prepare($sql);
			// 
			$ok = $seleciona->execute( array($email) );
			$dado = $seleciona->fetchAll(PDO::FETCH_ASSOC);
			$cont = count($dado);
			if ($cont != 1){
				throw new Exception('Ocorreu um erro!'.$cont);
			} 
			//print_r($dado);
		} catch (PDOException $e){
			# entra aqui se houver exceção PDO
			$error .= $e->getMessage();
		} catch (Error $e) {
			$error .= $e->getMessage();
		} catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			# entra aqui se houver exceção geral
			$error .= $t->getMessage();
		} catch (Exception $e){
			// Executed only in PHP 5.x, will not be reached in PHP 7
			# entra aqui se houver exceção geral
			$error .= $e->getMessage();
		} finally {
			# finally SEMPRE é executado
			if (!($ok) || !empty($error)){
				$error .= 'Email não registrado.';
			}

			if (!($ok) || !empty($error)){
				$msg = '<p class="alert alert-danger" >Problemas no envio do email. '.$error.'</p>';
			}
				header('location:index.php?mens='.$msg.'  '.$email);
			//echo $msg;
				
		}

		try {
			# se $error não estiver vazia,
			# gera exceção e não executa insert
			if (!empty($error)){
				throw new Exception($e);
			}
			$id = $dado['id'];
			$sql = 'UPDATE usuarios 
					SET	email_hash = ? 
					WHERE id = ?';
			$insercao = $conexao->prepare($sql);
			$ok = $insercao->execute(array($ehash,$id));
			$nome = $dado['nome'];
			
			$enviado = envia_email($nome,$email,$ehash);			
			if(!$enviado) {
				$error .= 'A mensagem não pôde ser enviada.';
			}
		
		} catch (PDOException $err){
			# entra aqui se houver exceção PDO
			$error .= $err->getMessage();
		} catch (Throwable $t) {
			// Executed only in PHP 7, will not match in PHP 5.x
			# entra aqui se houver exceção geral
			$error .= $t->getMessage();
		} catch (Exception $e){
			// Executed only in PHP 5.x, will not be reached in PHP 7
			# entra aqui se houver exceção geral
			$error .= $e->getMessage();
		} finally {
			# finally SEMPRE é executado
			if (!($ok) || !empty($error)){
				$msg = '<p class="alert alert-danger" >Problemas no envio do email. '.$error.'</p>';
			} else {
				$msg = '<p class="alert alert-success" >Enviado com sucesso! Verifique o seu email para ativar a sua conta!</p>';
			}
				header('location:index.php?mens='.$msg);
			//echo $msg;
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
	  <meta charset="utf-8" />
	  <title><?php echo $titulo; ?></title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	  <meta name="description" content="Pagina inicial" />
	  <meta name="author" content="Mascarenhas" />
	  <link href="css/bootstrap.min.css" rel="stylesheet" />
	  <script type="text/javascript" src="js/jquery.min.js" ></script>
	  <script type="text/javascript" src="js/bootstrap.min.js" ></script>
	</head>
	<body>
	  <div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> 
						 <a class="navbar-brand" href="#">Meu Site</a>
					</div>
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active">
								<a href="index.php">Home</a>
							</li>
							<li >
								<a href="listagem.php">Listagem</a>
							</li>
							<li>
								<a href="insere.php">Insere</a>
							</li>
								
							<li>
								<a href="altera.php">Altera</a>
							</li>
							<li >
								<a href="deleta.php">Deleta</a>
							</li>
							<li class="dropdown ">
								 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<strong class="caret"></strong></a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">Algo aqui</a>
									</li>
									<li>
										<a href="#">Outro aqui</a>
									</li>
									<li>
										<a href="#">Mais um aqui</a>
									</li>
									<li class="divider"> <!-- separador -->
									</li>
									<li>
										<a href="#">Link separado</a>
									</li>
									<li class="divider"> <!-- separador -->
									</li>
									<li>
										<a href="#">Outro link separado</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			    <ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider"></span>
					</li>
					<li class="active">
						<a href="listagem.php">Listagem</a> <span class="divider"></span>
					</li>
				</ul>
				<div class="page-header">
					<h2><?php $cabecalho; ?></h2>
					<form class="form-horizontal" action="forgetpass.php" method="post">
						<div class="form-group">
						<label for="email" class="control-label col-md-4">Email</label>
							<div class="col-md-4">
								<input type="text" name="email" class="form-control input-md" />
							</div>
						</div>
						<div class="form-group text-center">
							<div class="col-md-8" >
								<button type="submit" class="btn btn-success">Enviar</button>
							</div>
						</div>
					</form>
				</div>
				<div class= "foot well">
				<p>&copy; 2015 - ETE Mal. Mascarenhas de Moraes </p>
			</div>
		  </div>
		</div>
	  </div>
	</body>
</html>
