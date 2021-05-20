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
					
					while($row = $resultaat->fetch(SQLITE3_NUM)) {
						
						echo '<div class="item">
								<div class="itemFoto">
									<img class="Foto" source="./images/'.$row["productafbeelding"].'">
								</div>
								<div class="itemNaam">
									<p class="Naam">'.$row["productnaam"].'</p>
								</div>
								<div class="itemBeschrijving">
									<p class="Beschrijving">'.$row["productbeschrijving"].'</p>
								</div>
								<div class="itemPrijs">
									<br><p class="Prijs">€'.$row["prijs"].'</p>
								</div>
								<button class="verwijder" type="submit" name="verwijder">Verwijder</button>
							</div>';
					}

					echo '</div>';
				}	
				
			?>
			<div id="none"></div>
			<div id="afrekenen">
				<br><br>
				
				<?php
				if($aantalItems > 0) {
					while($row) {
						echo $row["productnaam"].': &nbsp; €'.$row["prijs"];
						echo '<br>';
					}
				}
				?>
				
				Verzendkosten: &nbsp; €7,95
				<hr>
				€ <?php //echo '$totaalprijs';?>
				<br><br>
				<button id="bestel" type="submit" name="bestel">Bestel</button>
			</div>
		</div>
    </div>
</body>
</html>