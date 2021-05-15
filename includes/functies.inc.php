<?php

function emptyInputSignup($voornaam, $achternaam, $emailadres, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord, $wachtwoordbevestiging) {
	if (empty($voornaam) || empty($achternaam) || empty($emailadres) || empty($woonplaats) || empty($postcode) || empty($straatnaam) || empty($huisnummer) || empty($wachtwoord) || empty($wachtwoordbevestiging)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

/*function invalidAdress($postcode, $straatnaam, $huisnummer) {
	$result;
	if () {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}*/

function invalidEmail($emailadres) {
	if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function passwordMatch($wachtwoord, $wachtwoordbevestiging) {
	if ($wachtwoord !== $wachtwoordbevestiging) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

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

function takenEmail($db, $emailadres) {
	$sql = "SELECT * FROM klanten WHERE email = :email;";

	//$stmt = sqlite3_stmt_init($db);
	//SQLite3::prepare($stmt);

	if (!$stmt = $db->prepare($sql)) {
		header("location: ../registratie.php?error=stmtfailed");
		exit;
	}
	
	$stmt->bindParam(":email", $emailadres);
	//SQLite3Stmt::bindParam($stmt, $emailadres);
	//sqlite3_stmt_bind_parameter_name($stmt, $emailadres);

	$stmt->execute();
	//SQLite3Stmt::execute($stmt);
	//sqlite3_stmt_execute($stmt);

	//$resultData = $stmt->execute();
	//$resultData = sqlite3_stmt_get_result($stmt);

	if($row = $stmt->fetch()) {
	//if ($row = sqlite3_fetch_assoc($stmt)) {
		return $row;
	} else {
		$result = false;
		return $result;
	}

	$stmt->close();
}

function createUser($db, $voornaam, $achternaam, $emailadres, $telefoonnummer, $woonplaats, $postcode, $straatnaam, $huisnummer, $wachtwoord) {
	//$sql = "INSERT INTO klanten (voornaam, achternaam, straatnaam, huisnummer, postcode, woonplaats, telefoonnummer, email, wachtwoord) VALUES (:voornaam, :achternaam, :straatnaam, :huisnummer, :postcode, :woonplaats, :telefoonnummer, :email, :wachtwoord);";
	$sql = "INSERT INTO klanten (voornaam, achternaam, straatnaam, huisnummer, postcode, woonplaats, telefoonnummer, email, wachtwoord) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

	if (!$stmt = $db->prepare($sql)) {
		header("location: ../registratie.php?error=stmtFailed");
		exit;
	}
	
	$encryptwachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

	$stmt->bindParam(1, $voornaam);
	$stmt->bindParam(2, $achternaam);
	$stmt->bindParam(3, $straatnaam);
	$stmt->bindParam(4, $huisnummer);
	$stmt->bindParam(5, $postcode);
	$stmt->bindParam(6, $woonplaats);
	$stmt->bindParam(7, $telefoonnummer);
	$stmt->bindParam(8, $emailadres);
	$stmt->bindParam(9, $encryptwachtwoord);

	$stmt->execute();
	$stmt=null;

	header("location: ../login.php");
	exit;
}

function emptyInputLogin($emailadres, $wachtwoord) {
	if (empty($emailadres) || empty($wachtwoord)) {
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}

function loginUser($db, $emailadres, $wachtwoord) {
	$takenEmail = takenEmail($db, $emailadres);
	
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