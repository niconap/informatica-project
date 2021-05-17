<!DOCTYPE html>
<html>
<head>
	<title>Tim's Art - Winkelwagentje</title>
	<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
	<link href="./css/cart.css?v=3" rel="stylesheet" type="text/css">
</head>
<body>
	<?php

		include_once "navigation.php";

		if (!isset($_SESSION["klantnummer"])) {
			header("location: ./login.php");
		}
	?>

	<div id="cartcontent">
        <h2>WINKELWAGEN</h2>
       	<p></p>
		<div id="grid">
			<div id="items">
				<div class="item">
				</div>
				<div class="item">
				</div>
				<?php
					/*if($aantalitems <= -1) {
						echo 'Er zitten geen items in uw winkelwagen';
					}*/
				?>
			</div>
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