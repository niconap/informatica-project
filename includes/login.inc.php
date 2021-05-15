<?php

if (isset($_POST["login"])) {
	
	$emailadres = $_POST["emailadres"];
	$wachtwoord = $_POST["wachtwoord"];
	
	require_once "../core/dbconnectie.php";
	require_once "functies.inc.php";
	
	if (emptyInputLogin($emailadres, $wachtwoord) !== false) {
		header("location: ../login.php?error=leeg");
		exit;
	}

	loginUser($db, $emailadres, $wachtwoord);
	
} else {
	header("location: ../login.php");
	exit;
}