<?php
function envia_email($nome,$email,$ehash){
	require_once('vendor/autoload.php');
	$n = $nome;
	$e = $email;
	$h = $ehash;
	
	$mail = new PHPMailer();	// instancia a classe						// Instancia a Classe
	$mail->SMTPDebug = 0;	// 0-5 nível das mensagens de debug             // Enable verbose debug output
	$mail->Debugoutput = 'html';	// ou 'text'                          	// Set mailer to use SMTP
	$mail->isSMTP();     // Usa servidores SMTP                         	// Set mailer to use SMTP
	$mail->Host = 'mail.gmx.com'; // endereco SMTP 							// Specify main and backup SMTP servers 'smtp1.example.com;smtp2.example.com'
	$mail->SMTPAuth = true;	// necessita autorizar                          // Enable SMTP authentication
	$mail->Username = 'jrborba.rs@gmx.com';  // username de envio       	  					// SMTP username
	$mail->Password = '';  // Senha de envio
	$mail->SMTPSecure = 'tls'; // seg. de autenticacao                          // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 25;   // porta do servidor SMTP                                 // TCP port to connect to

	// QUEM ENVIA
	$mail->From = 'jrborba.rs@gmx.com';// email
	$mail->FromName = 'CRUD Master'; // nome

	// QUEM RECEBE
	// email e nome
	$mail->addAddress($e, $n);   
	#$mail->addAddress('ellen@example.com');

	// responder para:
	$mail->addReplyTo('jrborba.rs@gmx.com.br', 'Jose Ricardo');

	// cópias: normais (CC) ou ocultas (BCC)
	#$mail->addCC('cc@example.com');
	#$mail->addBCC('bcc@example.com');

	// anexos
	#$mail->addAttachment('g4968.png');  // Anexo                
	#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Opcional

	// email em html (permite formatacao) ou texto (texto puro)
	$mail->isHTML(true);         // Formato do email => HTML

	// assunto e corpo da mensagem
	$mail->Subject = '[CRUD_Master] Email de confirmação.'; // assunto
	$mail->Body    = 'Obrigado por se registrar!<br/>
						Sua conta foi criada e você pode fazer login<br/>
						utilizando o seguinte nome de usuário:<br/>
						 
						------------------------<br/>
						Usuário: '.$n.'<br/>
						Email  : '.$e.'<br/>
						------------------------<br/>
												
						Você pode utilizar após <b> ATIVAR </b> a sua<br/>
						conta através do link abaixo. Basta clicar.<br/>
						 
						Por favor, clique <a href="http://localhost/aulas/inf9/aula3/verificaemail.php?ve='.$h.'"> aqui </a>  <br/>
						para ativar a sua conta.<br/>';
			
	$ok = false;
	if (!$mail->send()){
		throw new Exception('Ocorreu um erro ao enviar o email!');
	} else {
		$ok = true;
	} 		
	return $ok;
}
