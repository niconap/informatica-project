<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Bestelling succesvol</title>
		<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
		<link href="./css/pmsucces.css?v=3d" rel="stylesheet" type="text/css">
		<link rel="icon" href="./images/icon.png">
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

		?>

		<div id="pmcontent">
			<h2>BESTELLING IS GELUKT</h2>
			<p>
				Bedankt voor uw bestelling!<br>
				<br><br>
				U kunt uw bestelling(en) zien in "<a href="./bestellingen.php">Account → Bestellingen</a>".<br>
				<br>
				Als er iets ontbreekt of er is iets mis gegaan,<br>
				neem dan contact met ons op.<br>
				Dit kunt u doen op de pagina "<a href="./about.php">Over</a>".<br>
				<br><br>
				Met vriendelijke groeten,<br>
				Tim's Art<br>
				<br><br>
			</p>
			<form action="./index.php"><button id="terug" type="submit" name="terug">Terug naar het hoofdmenu</button>
		</div>
	</body>
</html>