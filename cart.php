<!DOCTYPE html>
<html>
<head>
	<title>Tim's Art - Winkelwagentje</title>
	<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
	<link href="./css/cart.css?v=3" rel="stylesheet" type="text/css">
</head>
<body>
	<?php

		require_once "navigation.php";

		if (!isset($_SESSION["klantnummer"])) {
			header("location: ./login.php");
			exit;
		}

		require_once "./includes/cart.inc.php";

	?>

	<div id="cartcontent">
        <h2>WINKELWAGEN</h2>
       	<p></p>
		<div id="grid">
			<?php
				
				if($aantalItems < 1) {
					echo 'Er zitten geen items in uw winkelwagen';
				} else {
					echo '<div id="items">';
					$oneTime = false;
					$totaalprijs = 7.95;

					while($row = $resultaat->fetch(SQLITE3_NUM)) {
						
						$productnaam = $row["productnaam"];
						$prijs = $row["prijs"];
						
						echo '<div class="item">
								<div class="itemFoto">
									<img class="Foto" src="./images/'.$row["productafbeelding"].'">
								</div>
								<div class="itemNaam">
									<p class="Naam">'.$productnaam.'</p>
								</div>
								<div class="itemBeschrijving">
									<p class="Beschrijving">'.$row["productbeschrijving"].'</p>
								</div>
								<div class="itemPrijs">
									<br><p class="Prijs">€'.$row["prijs"].'</p>
								</div>
								<button class="verwijder" type="submit" name="verwijder">Verwijder</button>
							</div>';

						if($oneTime === false) {
							echo '</div>';
							
							echo '<div id="none"></div>
							<div id="afrekenen">
								<br><br>';

							$oneTime = true;
						}
				
						echo $productnaam.': &nbsp; €'.$prijs;
						echo '<br>';

						$totaalprijs = $totaalprijs + $prijs;
					}
				}	
				
				$totaalprijs = str_replace('.', ',', $totaalprijs);
			
				echo 'Verzendkosten: &nbsp; €7,95
					<hr>
					€'.$totaalprijs.'
					<br><br>
					<button id="bestel" type="submit" name="bestel">Bestel</button>
				</div>';

			?>
		</div>
    </div>
</body>
</html>