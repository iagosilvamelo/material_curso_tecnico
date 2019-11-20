<?php
session_start();
// $_SESSION['vida'] é configurado no login.php

// Verifica se o usuário está autenticado
if ($_SESSION['login'] != 'OK'){
	$msg = '<p class="alert alert-danger" > Você não está logado! </p>';
	header('location:login.php?mens='.$msg);
}

// Verifica se o tempo ocioso ultrapassou $_SESSION['vida']
if ( isset($_SESSION['inicio']) ){
	$tempodecorrido = time() - $_SESSION['inicio'];
	if ( $tempodecorrido > $_SESSION['vida'] ){
		session_destroy();
		$msg = '<p class="alert alert-danger" > A sua sessão expirou! </p>';
		header('location:login.php?mens='.$msg);
	} // Posso dar mais 600s para o usuário, como abaixo no else... 
	else {
		$_SESSION['inicio'] = time();
		session_regenerate_id(true); // requinte de crueldade contra 
	} 								// ataques "man-in-the-middle"

} else {
	$msg = '<p class="alert alert-danger" > Você não está logado! </p>';
	header('location:login.php?mens='.$msg);
}
