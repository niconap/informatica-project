<?php
# In dit bestand staan alle functies die gebruikt worden om in te loggen of te registreren

# Checkt of de inputs tijdens het registreren niet leeg is
function emptyInputSignup($voornaam, $achternaam, $emailadres, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord, $wachtwoordbevestiging) {
	if (empty($voornaam) || empty($achternaam) || empty($emailadres) || empty($woonplaats) || empty($postcode) || empty($straatnaam) || empty($huisnummer) || empty($wachtwoord) || empty($wachtwoordbevestiging)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

# Checkt tijdens het registeren of het emailadres wel geldig is
function invalidEmail($emailadres) {
	if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

# Checkt of het wachtwoord en de wachtwoordbevestiging gelijk zijn tijdens de registratie
function passwordMatch($wachtwoord, $wachtwoordbevestiging) {
	if ($wachtwoord !== $wachtwoordbevestiging) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

# Checkt of het wachtwoord wel lang genoeg is
function passwordLength($wachtwoordbevestiging) {
	$count = 0;

	for($i = 0; $i < strlen($wachtwoordbevestiging); $i++) {  
		if($wachtwoordbevestiging[$i] != ' ')  
			$count++;  
	}

	if ($count < 6) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

# Checkt tijdens het registreren of het emailadres al gebruikt is
function takenEmail($db, $emailadres) {
	$sql = "SELECT * FROM klanten WHERE email = :email;";

	if (!$stmt = $db->prepare($sql)) {
		header("location: ../registratie.php?error=stmtfailed");
		exit;
	}
	
	$emailzonderhoofdletters = strtolower($emailadres);
	$stmt->bindParam(":email", $emailzonderhoofdletters);

	$stmt->execute();

	if($row = $stmt->fetch()) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	$stmt->close();
}

# Registreert de gebruiker en zet het in de database in de tabel klanten
function createUser($db, $voornaam, $achternaam, $emailadres, $telefoonnummer, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord, $antwoord) {
	If($antwoord != 10) {
		header("location: ../registratie.php?error=reken");
		exit;
	}
	
	$sql = "INSERT INTO klanten (voornaam, achternaam, straatnaam, huisnummer, postcode, woonplaats, telefoonnummer, email, wachtwoord) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

	if(!$stmt = $db->prepare($sql)) {
		header("location: ../registratie.php?error=stmtFailed");
		exit;
	}
	
	$encryptwachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
	$emailzonderhoofdletters = strtolower($emailadres);
	$postcodemethoofdletters = strtoupper($postcode);

	$stmt->bindParam(1, $voornaam);
	$stmt->bindParam(2, $achternaam);
	$stmt->bindParam(3, $straatnaam);
	$stmt->bindParam(4, $huisnummer);
	$stmt->bindParam(5, $postcodemethoofdletters);
	$stmt->bindParam(6, $woonplaats);
	$stmt->bindParam(7, $telefoonnummer);
	$stmt->bindParam(8, $emailzonderhoofdletters);
	$stmt->bindParam(9, $encryptwachtwoord);

	$stmt->execute();
	$stmt=null;

	header("location: ../login.php");
	exit;
}

# Checkt of de inputs tijdens het log in proces niet leeg is
function emptyInputLogin($emailadres, $wachtwoord) {
	if (empty($emailadres) || empty($wachtwoord)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

# Checkt of de informatie van de gebruiker correct is en logt de gebruiker in
function loginUser($db, $emailadres, $wachtwoord) {
	$emailzonderhoofdletters = strtolower($emailadres);
	$takenEmail = takenEmail($db, $emailzonderhoofdletters);
	
	if ($takenEmail === false) {
		header("location: ../login.php?error=verkeerdeLogin");
		exit;
	}

	$encryptwachtwoord = $takenEmail["wachtwoord"];

	$checkwachtwoord = password_verify($wachtwoord, $encryptwachtwoord);
	
	if ($checkwachtwoord === false) {
		header("location: ../login.php?error=verkeerdeLogin");
		exit;
	}elseif ($checkwachtwoord === true) {
		session_start();

		$_SESSION["klantnummer"] = $takenEmail["klantnummer"];
		$_SESSION["voornaam"] = $takenEmail["voornaam"];
		$_SESSION["achternaam"] = $takenEmail["achternaam"];
		$_SESSION["email"] = $takenEmail["email"];
		$_SESSION["telefoonnummer"] = $takenEmail["telefoonnummer"];
		$_SESSION["woonplaats"] = $takenEmail["woonplaats"];
		$_SESSION["postcode"] = $takenEmail["postcode"];
		$_SESSION["straatnaam"] = $takenEmail["straatnaam"];
		$_SESSION["huisnummer"] = $takenEmail["huisnummer"];

		header("location: ../index.php");
		exit;
	}
}