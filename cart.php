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
								<img class="itemFoto" source=".images/'.$row["productafbeelding"].'">
								<p class="itemNaam">'.$row["productnaam"].'</p>
								<p class="itemBeschrijving">'.$row["productbeschrijving"].'</p>
								<p class="itemPrijs">€'.$row["prijs"].'</p>
								<p class="itemAantal"></p>
							</div>';
					}

					/*
					for($i = 1; $i <= $aantalitems, $i++) {
						echo '<div class="item">

							</div>';
					}
					*/
					echo '</div>';
				}	
				
			?>
			<div id="none"></div>
			<div id="afrekenen">
				<br><br>
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