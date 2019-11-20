<!DOCTYPE html>
<html lang="pt-BR">
	<?php
	error_reporting(E_ALL);
	ini_set('display_errors','on');
	require_once('bd.php');
	$titulo = 'Alterar';
	$cabecalho = 'Altera usuário';

	if (!empty($_GET['id'])){
		$id = filter_var($_GET['id'],FILTER_VALIDATE_INT);
		$sql = 'SELECT * FROM usuarios WHERE id = ?';
		$alteracao = $conexao->prepare($sql);
		$alteracao->execute( array($id) );
		$dado = $alteracao->fetch(PDO::FETCH_ASSOC);
		//print_r($dado);
	} else {
		header('location:listagem.php');
	}
	
	if ( !empty($_POST) ){
		# recebe as variáveis do formulário
		$nome = $_POST['nome'];
		$turma = $_POST['turma'];
		$email = $_POST['email'];
		$id = $_POST['id'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($nome)){
			$error .= 'O nome não pode estar vazio.';
		}
		if (empty($turma)){
			$error .= 'A turma não pode estar vazia.';
		}
		if (empty($email)){
			$error .= 'O email não pode estar vazio.';
		}
		# filtra caracteres não-permitidos
		$nome = strip_tags(filter_var($nome));
		$turma = strip_tags(filter_var($turma));
		$email = strip_tags(filter_var($email, FILTER_VALIDATE_EMAIL));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$nome){
			$error .= 'O nome tem caracteres não permitidos.';
		}
		if (!$turma || strlen($turma)>2){
			$error .= 'A turma tem caracteres não permitidos ou tem mais de uma letra.';
		}
		if (!$email){
			$error .= 'O email não é válido.';
		}
		
		require_once('bd.php');
		# tenta inserir
		try {
			# se $error não estiver vazia,
			# gera exceção e não executa insert
			if (!empty($error)){
				throw new Exception($e);
			}
			$sql = 'UPDATE usuarios SET
			nome = ?,email = ?,turma = ? WHERE id = ?';
			$insercao = $conexao->prepare($sql);
			$ok = $insercao->execute( array($nome,$email,$turma,$id) );
		} catch (PDOException $err){
			# entra aqui se houver exceção PDO
			$error .= $err->getMessage();
		} catch (Exception $e){
			# entra aqui se houver exceção geral
			$error .= $e->getMessage();
		} finally {
			# finally SEMPRE é executado
			if (!($ok) || !empty($error)){
				$msg = '<p class="alert alert-danger" >Problemas na alteração. '.$error.'</p>';
			} else {
				$msg = '<p class="alert alert-success" >Alterado com sucesso!</p>';
			}
			header('location:listagem.php?mens='.$msg);
		}
	}
	?>
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
								<a href="inseri.php">Insere</a>
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
					<form class="form-horizontal" action="altera.php" method="post">
						<h2><?php $cabecalho; ?></h2>
						<input type="hidden" name="id" value="<?php echo $dado['id']; ?>" />
						<div class="form-group">
							<label for="nome" class="col-md-4 control-label">Nome</label>
							<div class="col-md-4">
								<input  class="form-control input-md" type="text" name="nome" value="<?php echo $dado['nome']; ?>" />
							</div>
						</div>
						<div class="form-group">
						<label for="email" class="control-label col-md-4">Email</label>
							<div class="col-md-4">
								<input type="text" name="email" class="form-control input-md" value="<?php echo $dado['email']; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="turma" class="control-label col-md-4">Turma</label>
							<div class="col-md-4">
								<input type="text" name="turma" class="form-control input-md" value="<?php echo $dado['turma']; ?>" />
							</div>
						</div>
						<div class="form-group text-center">
							<div class="col-md-8" >
								<button type="submit" class="btn btn-success">Gravar</button>
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
