<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Winkelwagen</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/cart.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="./images/icon.png">
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
									<form method="POST">
										<input class="invisbleInput" type="productnummer" placeholder="productnummer" name="productnummer">
										<button class="verwijder" type="submit" name='.$row["productnummer"].'>Verwijder</button>
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
					if (isset($_POST["productnummer"])) {
						# Maakt van de $_POST array een string
						$POST = print_r($_POST, true);
						
						# Haalt alle nummers uit de string
						$int = (int) filter_var($POST, FILTER_SANITIZE_NUMBER_INT);

						#telt het aantal nummers
						$lengte = strlen($int);

						switch ($lengte) {
							case $lengte == 1:
								$productnummer = substr($int, 0);
								break;
							case $lengte == 2:
								$productnummer = substr($int, 0, 2);
								break;
							case $lengte == 3:
								$productnummer = substr($int, 0, 3);
								break;
							case $lengte == 4:
								$productnummer = substr($int, 0, 4);
								break;
							case $lengte == 5:
								$productnummer = substr($int, 0, 5);
								break;
						}
			
						# Haalt de klantnummer uit de sessie			
						$klantnummer = $_SESSION["klantnummer"];
						echo $productnummer;

						removeCart($db, $klantnummer, $productnummer);
					}
				?>
			</div>
		</div>
	</body>
</html>