<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Account</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/account.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

	<?php
		# Navigatie oproepen
		include_once "navigation.php";
		if (!isset($_SESSION["klantnummer"])) {
			header("location: ../login.php");
		}
		include_once "./includes/edit.inc.php";
	?>

	<section>
		<div id="accounthok">
			<div id="accountinhoud">
				<h1>Account</h1>
				<br>
				<?php
					# Data van de klant weergeven
					echo '<p>Hallo '.$_SESSION['voornaam'].' '.$_SESSION['achternaam'].',</p><br>
						<a href="bestellingen.php">Hier</a> kunt u uw bestellingen bekijken.<br><br>
						
						<h3>Contactgegevens</h3>
						<p>Emailadres: '.$_SESSION['email'].'</p><br>
						<p>Telefoonnummer: '.$_SESSION['telefoonnummer'].'&nbsp<a href="?telefoonnummer">bewerk</a></p><br>
						
						<h3>Adres</h3>
						<p>Plaats: '.$_SESSION['woonplaats'].'&nbsp <a href="?woonplaats">bewerk</a></p>
						<p>Postcode: '.$_SESSION['postcode'].'&nbsp <a href="?postcode">bewerk</a>
						<p>Straatnaam: '.$_SESSION['straatnaam'].'&nbsp <a href="?straatnaam">bewerk</a></p>
						<p>Huisnummer: '.$_SESSION['huisnummer'].'&nbsp <a href="?huisnummer">bewerk</a></p><br>

						<h3>Wachtwoord</h3>
						<p>Wachtwoord: ○○○○○○</p><br>';

						#deze functies zorgen voor het verschijnen van de input en de knop en zorgen
						#voor het aanpassen van de informatie in de database
						echoInput();
						pasAan($db);
				?>
				<br>
				<form action="includes/logout.inc.php" method="post">
					<button id="loguit" type="submit" name="loguit">Log uit</button>
				</form>
			</div>
		</div>
	</section>

	</body>
</html>