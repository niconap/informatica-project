<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Bestellingen</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/bestellingen.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="./images/icon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			# Zorgt voor het oproepen van de navigatie
			include_once "./navigation.php";

			# Zorgt voor het sturen naar de login pagina, omdat je niet ingelogd bent
			if (!isset($_SESSION["klantnummer"])) {
				header("location: ../login.php");
			}

			# Het document waar we de functies vandaan halen
			include_once "./includes/bestellingen.inc.php";
		?>

		<div id="bestellingencontent">
			<h2>BESTELLINGEN</h2>

			<?php
				# Kijken welke items er besteld zijn en die op de pagina zetten
				if($aantalItems <= 0) {
					echo 'U heeft nog niks besteld of er is iets fout gegaan.<br><br>
						Als er iets fout gegaan is kunt u contact opnemen.<br>
						De gegevens van ons zijn op <a href="about.php">deze</a> pagina weergegeven.';
				} elseif ($aantalItems >= 1) {
					echo '<div id="items">';
					$oneTime = false;
					$totaalprijs = 7.95;

					while($row = $resultaat->fetch(SQLITE3_NUM)) {
						
						echo '<div class="item">
								<div class="itemFoto">
									<img class="Foto" src="./images/'.$row["productafbeelding"].'">
								</div>
								<div class="itemNummer">
									<p>Bestelnummer: '.$row["bestelnummer"].'</p>
								</div>
								<div class="itemNaam">
									<p class="Naam">'.$row["productnaam"].'</p>
								</div>
								<div class="itemDatum">
									<p>Besteldatum: '.$row["besteldatum"].'</p>
								</div>
								<div class="itemPrijs">
									<p>€'.$row["prijs"].'</p>
								</div>
								<div class="itemAantal">
									<p>'.$row["aantal"].' stuk(s)</p>
								</div>
							</div>';
					}
					echo '</div>';
					echo '<br><br>Als er iets fout gegaan is kunt u contact opnemen.<br>
						De gegevens van ons zijn op <a href="about.php">deze</a> pagina weergegeven.<br><br>';
				}	
			?>

		</div>
	</body>
</html>