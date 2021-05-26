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
		include_once "navigation.php";

		if (!isset($_SESSION["klantnummer"])) {
			header("location: ../login.php");
		}
	?>

	<section>
		<div id="accounthok">
			<div id="accountinhoud">
				<h1>Account</h1>
				<br>
				<?php
					echo '<p>Hallo '.$_SESSION['voornaam'].' '.$_SESSION['achternaam'].',</p><br>';
					
					echo '<a href="bestellingen.php">Hier</a> kunt u uw bestellingen bekijken.<br><br>';

					echo '<h3>Contactgegevens</h3>';
					echo '<p>Emailadres: '.$_SESSION['email'].'<br>Telefoonnummer: '.$_SESSION['telefoonnummer'].'</p><br>';
					
					echo '<h3>Adres</h3>';
					echo '<p>Plaats: '.$_SESSION['woonplaats'].'<br>Postcode: '.$_SESSION['postcode'].'<br>'.$_SESSION['straatnaam'].' '.$_SESSION['huisnummer'].'</p><br>';

					echo '<h3>Wachtwoord</h3>';
					echo '<p>Wachtwoord: ○○○○○○</p>';
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