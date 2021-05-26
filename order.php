<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Bestellen</title>
		<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
		<link href="./css/order.css?v=3" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			include_once "navigation.php";

			if (!isset($_SESSION["klantnummer"])) {
				header("location: ./index.php");
				exit;
			}

			include_once "./includes/cart.inc.php";
		?>

		<div id="ordercontent">
			<h2>BESTELLEN</h2>
			<p>Controleer of uw gegevens kloppen.</p><br>
			<?php
			echo '<p>Hallo '.$_SESSION['voornaam'].' '.$_SESSION['achternaam'].',</p><br><br>
				<h3>Contactgegevens</h3>
				<br>
				<table>
					<tr>
						<th class="firstrow">Telefoonnummer:</th>
						<th>'.$_SESSION['telefoonnummer'].'</th>
						<th><a href="?telefoonnummer">bewerk</a></th>					
					</tr>
					<tr>
						<th class="firstrow">Woonplaats:</th>
						<th>'.$_SESSION['woonplaats'].'</th>
						<th><a href="?woonplaats">bewerk</a></th>					
					</tr>
					<tr>
						<th class="firstrow">Postcode:</th>
						<th>'.$_SESSION['postcode'].'</th>
						<th><a href="?postcode">bewerk</a></th>
					</tr>
					<tr>
						<th class="firstrow">Straatnaam:</th>
						<th>'.$_SESSION['straatnaam'].'</th>
						<th><a href="?straatnaam">bewerk</a></th>					
					</tr>
					<tr>
						<th class="firstrow">Huisnummer:</th>
						<th>'.$_SESSION['huisnummer'].'</th>
						<th><a href="?huisnummer">bewerk</a></th>					
					</tr>
				</table>';

				#detecteert of iemand op 1 van de bewerk linkjes klikt
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

				echo '<br><br>
				<p>Hier komen de keuzes voor betalingen,<br>maar uit veiligheidsoverwegingen hebben wij die tijdelijk overgeslagen.</p>
				<br><br>
				<form method="POST">
					<button id="bestel" type="submit" name="bestel2">Bestel</button>
				</form>
				<br><br>
				';

				#registreert of iemand op de "Bestel" knop drukt
				if (isset($_GET["bestel2"])) {
					$klantnummer = $_SESSION["klantnummer"];
					bestel($db, $klantnummer);
				}

				#registreert en voert functie uit als iemand de knop "Pas aan" indrukt om de gegevens aan te passen
				if (isset($_POST["pasaan"])) {
					$klantnummer = $_SESSION["klantnummer"];
					if (isset($_POST["telefoonnummer"])) {
						$waarde = $_POST["telefoonnummer"];
						$kolom = "telefoonnummer";
						editInfo($db, $kolom, $waarde, $klantnummer);

					} elseif (isset($_POST["woonplaats"])) {
						$waarde = $_POST["woonplaats"];
						$kolom = "woonplaats";
						editInfo($db, $kolom, $waarde, $klantnummer);

					} elseif (isset($_POST["postcode"])) {
						$waarde = strtoupper($_POST["postcode"]);
						$kolom = "postcode";
						editInfo($db, $kolom, $waarde, $klantnummer);

					} elseif (isset($_POST["straatnaam"])) {
						$waarde = $_POST["straatnaam"];
						$kolom = "straatnaam";
						editInfo($db, $kolom, $waarde, $klantnummer);

					} elseif (isset($_POST["huisnummer"])) {
						$waarde = $_POST["huisnummer"];
						$kolom = "huisnummer";
						editInfo($db, $kolom, $waarde, $klantnummer);
					}
				}

				/*#registreert of iemand op de "Pas aan" knop heeft gedrukt
				if(empty($_POST["emailadres"])){
					$knop = $_POST["emailadres"];
				}
				#switch () {

				#}

				switch ($_POST[$knop]) {
					case $knop = "emailadres":

						break;
					case $knop = "telefoonnummer":
						
						break;
				}*/
			?>
		</div>
	</body>
</html>