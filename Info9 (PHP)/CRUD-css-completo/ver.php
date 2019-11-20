<!DOCTYPE html>
<html lang="pt-BR">
	<?php
	error_reporting(E_ALL);
	ini_set('display_errors','on');
	require_once('bd.php');	
	
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
	?>
	<head>
	  <meta charset="utf-8" />
	  <title>Ver</title>
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
					
						<h2>Ver usuário</h2>
						
						<dl class="dl-horizontal">
							<dt>Nome</dt>
							<dd><?php echo $dado['nome']; ?></dd>
						</dl>
						
						<dl class="dl-horizontal">
							<dt>Email</dt>
							<dd><?php echo $dado['email']; ?></dd>
						</dl>
						
						<dl class="dl-horizontal">
							<dt>Turma</dt>
							<dd><?php echo $dado['turma']; ?></dd>
						</dl>
						
						<div class="form-group text-center">
							<div class="col-md-8" >
								<a href="listagem.php" class="btn btn-default">Voltar</a>
							</div>
						</div>
						
				</div> <!-- class="page header" -->
				<div class= "foot well">
				<p>&copy; 2015 - ETE Mal. Mascarenhas de Moraes </p>
			</div>
		  </div>
		</div>
	  </div>
	</body>
</html>
