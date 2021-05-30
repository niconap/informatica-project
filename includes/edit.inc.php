<?php
# Zorgt voor het laten zien van de input en de knop als iemand op de "bewerl" link klikt
function echoInput() {
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$link = substr($url, strrpos($url, '?') + 1);
	if (isset($_GET[$link])) {
		switch ($link) {
			case "telefoonnummer":
				echo '<form method="POST">
						<input type="telefoonnummer" name="telefoonnummer" placeholder="Telefoonnummer" required>
						<button id="pasaan" type="submit" name="pasaan">Pas aan</button>
					</form>';
				break;
			case "woonplaats":
				echo '<form method="POST">
						<input type="text" name="woonplaats" placeholder="Woonplaats" required>
						<button id="pasaan" type="submit" name="pasaan">Pas aan</button>
					</form>';
				break;
			case "postcode":
				echo '<form method="POST">
						<input type="text" name="postcode" placeholder="Postcode" required>
						<button id="pasaan" type="submit" name="pasaan">Pas aan</button>
					</form>';
				break;
			case "straatnaam":
				echo '<form method="POST">
						<input type="text" name="straatnaam" placeholder="Straatnaam" required>
						<button id="pasaan" type="submit" name="pasaan">Pas aan</button>
					</form>';
				break;
			case "huisnummer":
				echo '<form method="POST">
						<input type="text" name="huisnummer" placeholder="Huisnummer" required>
						<button id="pasaan" type="submit" name="pasaan">Pas aan</button>
					</form>';
				break;
		}
	}
}

# Registreert en voert functie uit als iemand de knop "Pas aan" indrukt om de gegevens aan te passen
function pasAan($db) {	
	if (isset($_POST["pasaan"])) {
		$klantnummer = $_SESSION["klantnummer"];
		if (isset($_POST["telefoonnummer"])) {
			$waarde = $_POST["telefoonnummer"];
			$kolom = 'telefoonnummer';
			editInfo($db, $kolom, $waarde, $klantnummer);

		} elseif (isset($_POST["woonplaats"])) {
			$waarde = $_POST["woonplaats"];
			$kolom = 'woonplaats';
			editInfo($db, $kolom, $waarde, $klantnummer);

		} elseif (isset($_POST["postcode"])) {
			$waarde = strtoupper($_POST["postcode"]);
			$kolom = 'postcode';
			editInfo($db, $kolom, $waarde, $klantnummer);

		} elseif (isset($_POST["straatnaam"])) {
			$waarde = $_POST["straatnaam"];
			$kolom = 'straatnaam';
			editInfo($db, $kolom, $waarde, $klantnummer);

		} elseif (isset($_POST["huisnummer"])) {
			$waarde = $_POST["huisnummer"];
			$kolom = 'huisnummer';
			editInfo($db, $kolom, $waarde, $klantnummer);
		}
	}
}

# Wijzigt de gegevens uit account of tijdens de bestelling, wanneer de gebruiker dit opvraagt
function editInfo($db, $kolom, $waarde, $klantnummer) {
	$sqledit = 'UPDATE klanten SET '.$kolom.'=:waarde WHERE klantnummer=:klantnummer';

	if(!$stmt = $db->prepare($sqledit)) {
		header("location: ../index.php");
		exit;
	}
	
	$stmt->bindParam(':waarde', $waarde);
	$stmt->bindParam(':klantnummer', $klantnummer);

	$stmt->execute();
	$stmt=null;

	$_SESSION[$kolom] = $waarde;

	header("Refresh:0");
	exit;
}