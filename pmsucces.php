<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Bestelling succesvol</title>
		<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
		<link href="./css/pmsucces.css?v=3" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			include_once "navigation.php";

			if (!isset($_SESSION["klantnummer"]) OR !isset($_POST["bestel2"])) {
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