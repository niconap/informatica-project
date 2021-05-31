<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Registratie</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/registratie.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			# Zorgt voor het oproepen van de navigatie
			include_once "navigation.php";

			# Zorgt voor het sturen naar de login pagina, omdat je niet ingelogd bent
			if (isset($_SESSION["klantnummer"])) {
				header("location: ./index.php");
			}
		?>

		<section>
				<div id="registratiehok">
					<div id="registratieinhoud">
						<h1>Registreren</h1>
					<form action="includes/registratie.inc.php" method="post">
						<br>	
						<label>Vul uw naam in:</label>
						<br>
						<input type="text" name="voornaam" placeholder="Voornaam" required>
						<br>
						<input type="text" name="achternaam" placeholder="Achternaam" required>
						<br><br>

						<label>Vul uw emailadres in:</label>
						<br>
						<input type="email" name="emailadres" placeholder="Emailadres" required>
						<br><br>

						<label>Vul uw telefoonnummer in: (niet verplicht)</label>
						<br>
						<input type="tel" name="telefoonnummer" placeholder="Telefoonnummer">
						<br><br>

						<label>Vul uw adres in:</label>
						<br>
						<input type="text" name="woonplaats" placeholder="Woonplaats" required>
						<br>
						<input type="text" name="postcode" placeholder="Postcode" required>
						<br>
						<input type="text" name="straatnaam" placeholder="Straatnaam" required>
						<br>
						<input type="text" name="huisnummer" placeholder="Huisnummer" required>
						<br><br>

						<label>Vul uw wachtwoord in:</label>
						<br>
						<input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
						<br>
						<input type="password" name="wachtwoordbevestiging" placeholder="Wachtwoord bevestigen" required>
						<br><br>

						<label>Wat is vijf plus vijf?</label>
						<br>
						<input type="number" name="antwoord" placeholder="Antwoord" required>
						<br><br>

						<?php
							# Kijken of alle gegevens geldig zijn
							if (isset($_GET["error"])) {
								echo '<div id = "error">';
								if ($_GET["error"] == "leeg") {
									echo "<p>Vul alle velden in!</p>";
								} elseif ($_GET["error"] == "ongeldigEmail") {
									echo "<p>Dit emailadres is ongeldig!</p>";
								} elseif ($_GET["error"] == "emailInGebruik") {
									echo "<p>Dit emailadres is al in gebruik!</p>";
								} elseif ($_GET["error"] == "wachtwoordNietBevestigd") {
									echo "<p>De bevestiging van het wachtwoord komt niet overeen!</p>";
								} elseif ($_GET["error"] == "wachtwoordLengte") {
									echo "<p>Het wachtwoord moet langer dan 6 tekens zijn!</p>";
								} elseif ($_GET["error"] == "stmtfailed") {
									echo "<p>Er is iets mis gegaan, probeer opnieuw!</p>";
								} elseif ($_GET["error"] == "reken") {
									echo "<p>Het antwoord op de rekenvraag is fout, probeer opnieuw!</p>";
								}
								echo "</div><br>";
							}
						?>
						<button id="registreer" type="submit" name="registreer">Registreer</button>
					</form>
				</div>
				</div>
		</section>

	</body>
</html>