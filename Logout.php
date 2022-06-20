<?php 
	session_start();
	$_SESSION['Id'] =$Fila['IdUsuario'];
	session_destroy();
	header('Location: index.html');
?>