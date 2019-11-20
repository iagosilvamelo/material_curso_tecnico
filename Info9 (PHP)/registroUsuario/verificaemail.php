<?php
error_reporting(E_ALL);
ini_set('display_errors','on');
require_once('bd.php');
$titulo = 'Verificação de email';
$cabecalho = 'Entre com sua senha:';

if ( !empty($_POST) ){
		# recebe as variáveis do formulário
		$id = $_POST['id'];
		$senha = $_POST['senha'];
		$senha1 = $_POST['senha1'];
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';
		# testa se vazio 
		if (empty($id)){
			$error .= 'O id não pode estar vazio.';
		}
		if (empty($senha)){
			$error .= 'A senha não pode estar vazia.';
		}
		if (empty($senha1)){
			$error .= 'A repetição da senha não pode estar vazia.';
		}
		# filtra caracteres não-permitidos
		$id = strip_tags(filter_var($id, FILTER_VALIDATE_INT));
		$senha = strip_tags(filter_var($senha));
		$senha1 = strip_tags(filter_var($senha1));
		# Se caracteres não permitidos,
		# incrementa $error com as mensagens
		if (!$id){
			$error .= 'O id não é válido.';
		}
		if (!$senha || strlen($senha)<6){
			$error .= 'A senha tem caracteres não permitidos ou tem menos de 6 caracteres.';
		}
		if (!$senha1){
			$error .= 'A repetição da senha tem caracteres não permitidos.';
		}
		if ($senha1 != $senha){
			$error .= 'A repetição da senha não confere.';
		}
		$hashopt = [
			'cost' => 12 // default = 10
		];
		$phash = password_hash($senha, PASSWORD_DEFAULT,$hashopt);
		# tenta inserir
		require_once('bd.php');
		# usuário deve estar ativo após confirmarem o email
		$ativo = true;
		$ehash = null;	
		try {
			# se $error não estiver vazia,
			# gera exceção e não executa insert
			if (!empty($error)){
				throw new Exception($e);
			}
			$sql = 'UPDATE usuarios
					SET senha = ?, ativo = ?, email_hash = ? 
					WHERE id = ?';
			$insercao = $conexao->prepare($sql);
			$ok = $insercao->execute( array($phash,$ativo, $ehash,$id) );
		
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
				$msg = '<p class="alert alert-danger" >Problemas na verificação. '.$error.'</p>';
			} else {
				$msg = '<p class="alert alert-success" >Verificado com sucesso!</p>';
			}
			echo $msg;
			//header('location:index.php?mens='.$msg);
		}
}

if ( !empty($_GET) && isset($_GET['ve']) ){
		# inicializa variáveis de controle
		$error = '';
		$ok='';
		$e='';

	$hash = strip_tags(filter_var($_GET['ve']));
	# testa se vazio 
	if (empty($hash)){
		$error .= 'O hash é inválido!';
	}
	# tenta encontrar
	try {
		$sql = 'SELECT id, nome, email_hash
				FROM usuarios
				WHERE email_hash = ?';
		$ve = $conexao->prepare($sql);
		$ok = $ve->execute( array($hash) );
		$dado = $ve->fetch(PDO::FETCH_ASSOC);
		# conta os encontrados
		$cont = $ve->rowCount();
		$conexao = null;
		if ($cont !== 1){
			throw new Exception('Ocorreu um erro!');
		}
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
			$msg = '<p class="alert alert-danger" >Problemas na verificação. '.$error.'</p>';
			echo $msg;
			//header('location:index.php?mens='.$msg);
		}
	}
} else {
	$msg = '<p class="alert alert-danger" >Problemas na verificação.</p>';
	header('location:index.php?mens='.$msg);
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
	</head>
	<body>
	  <div class="container">
		<div class="row clearfix">
			<div class="col-md-12 column">
	
				<div class="page-header">
					<h2><?php $cabecalho; ?></h2>
					<form class="form-horizontal" action="verificaemail.php" method="post">
						<input type="hidden" name="id" value="<?php echo $dado['id'];  ?>" />
						<div class="form-group">
							<label for="usuario" class="col-md-4 control-label">Usuário</label>
							<div class="col-md-4">
								<p><?php echo $dado['nome']; ?></p>
							</div>
						</div>
						<div class="form-group">
						<label for="senha" class="control-label col-md-4">Senha</label>
							<div class="col-md-4">
								<input type="password" name="senha" class="form-control input-md"  />
							</div>
						</div>
						<div class="form-group">
						<label for="senha" class="control-label col-md-4">Repita a senha</label>
							<div class="col-md-4">
								<input type="password" name="senha1" class="form-control input-md"  />
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
	  <script type="text/javascript" src="js/jquery.min.js" ></script>
	  <script type="text/javascript" src="js/bootstrap.min.js" ></script>
	</body>
</html>
