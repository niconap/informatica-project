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
			# Zorgt voor het oproepen van de navigatie
			include_once "navigation.php";

			# Zorgt voor het sturen naar de login pagina, omdat je niet ingelogd bent
			if (!isset($_SESSION["klantnummer"])) {
				header("location: ./index.php");
				exit;
			}

			# Het document waar we de functies vandaan halen
			include_once "./includes/cart.inc.php";
			include_once "./includes/edit.inc.php";
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
						<th class="firstrow">Telefoonnummer: &nbsp</th>
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

				echoInput();

				echo '<br><br>
				<p>Hier komen de keuzes voor betalingen,<br>maar uit veiligheidsoverwegingen hebben wij die tijdelijk overgeslagen.</p>
				<br><br>
				<form method="POST">
					<button id="bestel" type="submit" name="bestel2">Bestel</button>
				</form>
				<br><br>
				';

				pasAan($db);
			?>
		</div>
	</body>
</html>