	<?php
	session_start(); // Inicializa o controle de sessões do PHP
	
	error_reporting(E_ALL);
	ini_set('display_errors','on');

	require_once('bd.php');
	$titulo = 'login';
	$cabecalho = 'Login de usuário';
	
	if ( !empty($_POST) ){
		# recebe as variáveis do formulário
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($usuario)){
			$error .= 'O usuário não pode estar vazio.';
		}
		if (empty($senha)){
			$error .= 'A senha não pode estar vazia.';
		}
		# filtra caracteres não-permitidos
		$usuario = strip_tags(filter_var($usuario));
		$senha = strip_tags(filter_var($senha));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$usuario){
			$error .= 'O usuario ou senha com problemas.';
		}
		if (!$senha || strlen($senha)<6){
			$error .= 'O usuario ou senha com problemas.';
		}
		# tenta encontrar
		$ativo = true;
		try {
			$sql = 'SELECT nome, senha
					FROM usuarios
					WHERE nome = ? AND ativo = ?';
						
			$login = $conexao->prepare($sql);
			$ok = $login->execute( array($usuario,$ativo) );
			$dado = $login->fetch(PDO::FETCH_ASSOC);
			// $hsenha = MD5($senha);
			// if($dado['senha'] == $hsenha){
			//		$verif = true;
			//	} else {
			//		$verif = false;
			//	}
			
			$verif = password_verify($senha,$dado['senha']);
			//echo 'VERIF: '.$verif.'<br/>';
			$conexao = null;
			$ok = $verif;

		} catch (PDOException $err){
			# entra aqui se houver exceção PDO
			$error .= $err->getMessage();
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
				$msg = '<p class="alert alert-danger" >Problemas no login. '.urlencode($error).'</p>';
			} else {
				$_SESSION['login'] = 'OK';
				$_SESSION['usuario'] = $dado['nome'];
				$_SESSION['inicio'] = time();	// carimbo de entrada no sistema
				$_SESSION['vida'] = 600; // 60s = 1min ==> tempo de permanência
				$msg = '<p class="alert alert-success" >Logado com sucesso, '.$dado['nome'].'</p>';
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
				<div class="page-header">
					<h2><?php echo $cabecalho; ?></h2>
					<form class="form-horizontal" action="login.php" method="post">
						<fieldset>
						<div class="form-group">
							<label for="usuario" class="col-md-4 control-label">Usuário</label>
							<div class="col-md-4">
								<input  class="form-control input-md" type="text" name="usuario"  />
							</div>
						</div>
						<div class="form-group">
						<label for="senha" class="control-label col-md-4">Senha</label>
							<div class="col-md-4">
								<input type="password" name="senha" class="form-control input-md"  />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4">
								<p><a href="forgetpass.php">Esqueci minha senha</a> | <a href="registra.php">Registrar</a></p>
							</div>
						</div>

						<div class="form-group text-center">
							<div class="col-md-8" >
								<button type="submit" class="btn btn-success">Enviar</button>
							</div>
						</div>
						</fieldset>
					</form>
				</div>
				<?php
					if (!empty($_GET['mens'])){
						echo strip_tags(filter_var($_GET['mens']),'<p>');
					}
				?>
				<div class= "foot well">
				<p>&copy; 2015 - ETE Mal. Mascarenhas de Moraes </p>
			</div>
		  </div>
		</div>
	  </div>
	</body>
</html>
