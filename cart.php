<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Winkelwagen</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/cart.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			# Navigatie oproepen
			include_once "navigation.php";

			# Gebruikers die niet ingelogd zijn naar het login scherm sturen
			if (!isset($_SESSION["klantnummer"])) {
				header("location: ./login.php");
				exit;
			}

			# Het document waar we de functies vandaan halen
			include_once "./includes/cart.inc.php";
		?>

		<div id="cartcontent">
			<h2>WINKELWAGEN</h2>
			<div id="grid">
				<?php
					# Kijken welke items er in de winkelmand zitten
					if($aantalItems <= 0) {
						echo 'Er zitten geen items in uw winkelwagen';
					} elseif ($aantalItems >= 1) {
						echo '<div id="items">';
						$oneTime = false;
						$totaalprijs = 7.95;

						while($row = $resultaat->fetch(SQLITE3_NUM)) {
							
							echo '<div class="item">
									<div class="itemFoto">
										<img class="Foto" src="./images/'.$row["productafbeelding"].'">
									</div>
									<div class="itemNaam">
										<p class="Naam">'.$row["productnaam"].'</p>
									</div>
									<div id="none"></div>
									<div class="itemBeschrijving">
										<p class="Beschrijving">'.$row["productbeschrijving"].'</p>
									</div>
									<div class="itemPrijs">
										<br><p class="Prijs">€'.$row["prijs"].'</p>
										<br><p>'.$row["aantal"].' stuk(s)</p>
									</div>
									<form method="GET">
										<input class="invisbleInput" type="productnummer" placeholder="productnummer" name="productnummer">
										<button class="verwijder" type="submit" name="'.$row["productnummer"].'">Verwijder</button>
									</form>
								</div>';

							$prijs = $row["prijs"];
							$totaalprijs = $totaalprijs + $row["aantal"]*$prijs;
						}
						echo '</div>';
						echo '<div id="afrekenen">
							<br><br>';

						$totaalprijs = str_replace('.', ',', $totaalprijs);
					
						echo 'Verzendkosten: &nbsp; €7,95
							<hr>
							€'.$totaalprijs.'
							<br><br>
							<form action="./order.php" method="POST">
								<button id="bestel" type="submit" name="bestel">Bestel</button>
							</form>
						</div>';
					}	
					
				
					
					# Registreert of iemand de verwijder knop indrukt
					if (isset($_GET["productnummer"])) {
						$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
						# Haalt het productnummer uit de url
						$productnummer = substr($url, strrpos($url, '&') + 1, 1);				
						$klantnummer = $_SESSION["klantnummer"];

						removeCart($db, $klantnummer, $productnummer);
					}
				?>
			</div>
		</div>
	</body>
</html>