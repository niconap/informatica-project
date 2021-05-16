<?php

if (isset($_POST["registreer"])) {
	
	$voornaam = $_POST["voornaam"];
	$achternaam = $_POST["achternaam"];
	$emailadres = $_POST["emailadres"];
	$telefoonnummer = $_POST["telefoonnummer"];
	$woonplaats = $_POST["woonplaats"];
	$postcode = $_POST["postcode"];
	$straatnaam = $_POST["straatnaam"];
	$huisnummer = $_POST["huisnummer"];
	$wachtwoord = $_POST["wachtwoord"];
	$wachtwoordbevestiging = $_POST["wachtwoordbevestiging"];
	$antwoord = $_POST["antwoord"];
	
	require_once "../core/dbconnectie.php";
	require_once "functies.inc.php";
	
	if (emptyInputSignup($voornaam, $achternaam, $emailadres, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord, $wachtwoordbevestiging) !== false) {
		header("location: ../registratie.php?error=leeg");
		exit;
	}
	/*if (invalidAdress($postcode, $straatnaam, $huisnummer) !== false) {
		header("location: ../registratie.php?error=ongeldig huisadres");
		exit;
	}*/
	if (invalidEmail($emailadres) !== false) {
		header("location: ../registratie.php?error=ongeldigEmail");
		exit;
	}
	if (takenEmail($db, $emailadres) !== false) {
		header("location: ../registratie.php?error=emailInGebruik");
		exit;
	}
	if (passwordMatch($wachtwoord, $wachtwoordbevestiging) !== false) {
		header("location: ../registratie.php?error=wachtwoordNietBevestigd");
		exit;
	}
	if (passwordLength($wachtwoordbevestiging) !== false) {
		header("location: ../registratie.php?error=wachtwoordLengte");
		exit;
	}

	createUser($db, $voornaam, $achternaam, $emailadres, $telefoonnummer, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord, $antwoord);
	
} else {
	header("location: ../registratie.php");
	exit;
}