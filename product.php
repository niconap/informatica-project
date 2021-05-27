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
			# Navigatie oproepen
			include_once "navigation.php";
			include_once "./core/dbconnectie.php";
		?>
		<div id="content">
			<?php
				# Kijken of er een product is geselecteerd, zo niet dan wordt de gebruiker teruggestuurd 
				if(!$_GET['productnummer']){
					header("location: ./index.php");
				}

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
						echo '<a id="button">In winkelmandje</a>';
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

					echo '<br><br><br>
						<p id="beschrijving">'.$row["productbeschrijving"].'</p>';
				}
			?>
		</div>
	</body>
</html>