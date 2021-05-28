<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Log in</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/login.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

	<?php
		include_once "navigation.php";

		if (isset($_SESSION["klantnummer"])) {
			header("location: ./index.php");
		}
	?>

	<section>
		<div id="loginhok">
			<div id="logininhoud">
				<h1>Log in</h1>
				<form action="includes/login.inc.php" method="post">
					<br>
					<label>Vul uw emailadres in:</label>
					<br>
					<input type="email" name="emailadres" placeholder="Emailadres" required>
					<br><br>
					<label>Vul uw wachtwoord in:</label>
					<br>
					<input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
					<br><br>
					<?php
						# Kijken of de ingevoerde gegevens geldig zijn
						if (isset($_GET["error"])) {
							echo "<div id='error'>";
							if ($_GET["error"] == "leeg") {
								echo "<p>Vul alle velden in!</p>";
							} elseif ($_GET["error"] == "verkeerdeLogin") {
								echo "<p>Emailadres of wachtwoord is onjuist, probeer opnieuw!</p>";
							}
							echo "</div><br>";
						}
					?>
					<button id="login" type="submit" name="login">Log in</button>
					<br><br>
					Klik <a href="registratie.php">hier</a> als u nog geen account heeft
				</form>
			</div>
		</div>
	</section>

	</body>
</html>