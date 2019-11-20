<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('America/Sao_Paulo');

require_once('database.php'); // equivale ao import

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Teste</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	
	<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="index.html">Home</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="index.html">Home</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mais pÃ¡ginas<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="p1.html">PÃ¡gina 1</a>
								</li>
								<li>
									<a href="p2.html">PÃ¡gina 2</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="p3.html">PÃ¡gina 3</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
						
		</div>
	</div>
</div>

<p class = "alert alert-success">
<?php
	if (!empty($_GET['mens'])){
		echo $_GET['mens'];
	}
?>
</p>

<?php

if (!empty($erro)) {
	echo '<p>Houve um problema no acesso ao
	 banco de dados. Contate o administrador 
	 e diga que ocorreu o erro
	  <b>'.$erro.' </b></p>';
}

$sql = 'SELECT * FROM marcas';	// string SQL de consulta
$consulta = $conexao->query($sql); // consulta a tabela
$dados = $consulta->fetchAll(PDO::FETCH_ASSOC); // disponibiliza os dados na forma de um array

//echo '<pre>';
//print_r($dados);
//echo '</pre>';

echo '<p><a class="btn btn-success" href="inserir.php">INSERIR</a></p>';


echo '<table class="table table-stripped table-bordered table-condensed">';
echo '<thead>';
echo '<tr>';
echo '<th>Nome</th>
		<th>Origem</th>
		<th>Presidente</th>
		<th>Fundacao</th>
		<th>AÃ§Ãµes</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach($dados as $d) {
	echo '<tr>	<td>'.$d['Nome'].'</td>
				<td>'.$d['Origem'].'</td>
				<td>'.$d['Presidente'].'</td>
				<td>'.$d['Fundacao'].'</td>
				<td><a class="btn btn-default" href="ver.php?id='.$d['id'].'">VER</a>
				<a class="btn btn-warning" href="alterar.php?id='.$d['id'].'">ALTERAR</a>
				<a class="btn btn-danger" href="deletar.php?id='.$d['id'].'">DELETAR</a></td>
		</tr>';
}
echo '</tbody>';
echo '</table>';

?>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>

