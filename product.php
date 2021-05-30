<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Account</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/product.css" rel="stylesheet" type="text/css">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php 
			# Zorgt voor het oproepen van de navigatie
			include_once "./navigation.php";

			# Kijken of er een product is geselecteerd, zo niet dan wordt de gebruiker teruggestuurd 
			if(!$_GET['productnummer']){
				header("location: ./index.php");
			}

			# Het document waar we de functies vandaan halen
			include_once "./includes/index.inc.php"
		?>
		<div id="content">
			<?php
				# De data van het product weergeven
				$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$productnummer = substr($url, strrpos($url, '=') + 1, 1);
				$sql = 'SELECT * FROM producten WHERE productnummer='.$productnummer;
				$resultaat = $db->query($sql);
				$row = $resultaat->fetch(SQLITE3_NUM);

				if ($row["voorraad"] == 0) {
					header("location: ./index.php#ourcollection");
				} elseif ($row["voorraad"] == 1) {
					echo '<img src="./images/'.$row["productafbeelding"].'">
						<h2>'.$row["productnaam"].'</h2>
						<p>Prijs: €'.$row["prijs"].'</p>
						<br>';

					if (isset($_SESSION["klantnummer"])) {
						echo '<form method="POST">
								<input class="invisibleInput" name="productnummer"></input>
								<button id="button" type="submit" name="'.$productnummer.'">In winkelmandje</button>
							</form>';
					} else {
						echo '<span id="disabled">
								<a href="./registratie.php">
									Maak een account aan
								</a> of 
								<a href="login.php">
									log in
								</a>
								</span>';
					}

					echo '<br><p id="beschrijving">'.$row["productbeschrijving"].'</p>';
				}	

				# Registreert of iemand de "In winkelmandje" knop indrukt
				if (isset($_POST["productnummer"])) {
					# Maakt van de $_POST array een string
					$POST = print_r($_POST, true);
					
					# Haalt alle nummers uit de string
					$int = (int) filter_var($POST, FILTER_SANITIZE_NUMBER_INT);
								
					# Haalt het productnummer uit de nummers
					$productnummer = substr($int, 0, 1);

					# Haalt het klantnummer uit de sessie
					$klantnummer = $_SESSION["klantnummer"];

					# Stopt alle informatie in de functie om het in het winkelmandje te krijgen
					addCart($db, $klantnummer, $productnummer);
				}
			?>
		</div>
	</body>
</html>