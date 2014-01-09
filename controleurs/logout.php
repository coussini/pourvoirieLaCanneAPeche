<?php
	session_start();
	$_SESSION = array();	// initialisation du tableau des variables de la session client
	session_destroy();		// destruction de la session
	header("Location: ../index.php");
?>
