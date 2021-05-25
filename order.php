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
				header("location: ./login.php");
				exit;
			}

			include_once "./includes/cart.inc.php";
		?>

		<div id="ordercontent">
			<h2>BESTELLEN</h2>
			<p>Controleer of uw gegevens kloppen.</p><br>
			<?php
			echo '<p>Hallo '.$_SESSION['voornaam'].' '.$_SESSION['achternaam'].',</p><br>
				<h3>Contactgegevens</h3>
				<br>
				<table>
					<tr>
						<th>Emailadres:</th>
						<th>'.$_SESSION['email'].'</th>
						<th><a href="">bewerk</a></th>					</tr>
					<tr>
						<th>Telefoonnummer:</th>
						<th>'.$_SESSION['telefoonnummer'].'</th>
						<th><a href="">bewerk</a></th>					</tr>
					<tr>
						<th>Woonplaats:</th>
						<th>'.$_SESSION['woonplaats'].'</th>
						<th><a href="">bewerk</a></th>					</tr>
					<tr>
						<th>Postcode:</th>
						<th>'.$_SESSION['postcode'].'</th>
						<th><a href="">bewerk</a></th>
					</tr>
					<tr>
						<th>Straatnaam:</th>
						<th>'.$_SESSION['straatnaam'].'</th>
						<th><a href="">bewerk</a></th>					</tr>
					<tr>
						<th>Huisnummer:</th>
						<th>'.$_SESSION['huisnummer'].'</th>
						<th><a href="">bewerk</a></th>					</tr>
				</table>
				';
			?>
		</div>
	</body>
</html>