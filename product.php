<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Account</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/product.css?v=3" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php 
			include_once "navigation.php";
		?>
		<div id="content">
			<?php
				# Uiteindelijk moet alle informatie hier uit de database gehaald worden

				$product = $_GET['product'];
				echo "<img src=\"images/". $product .".jpg\">
				<h2>".$product."</h2>
				<p>Prijs: onbekend</p>
				<br>";
				if (isset($_SESSION["klantnummer"])) {
					echo "<a id=\"button\">In winkelmandje</a>";
				} else {
					echo "<span id=\"disabled\">
									<a href=\"./registratie.php\">
										Maak een account aan
									</a> of 
									<a href=\"login.php\">
										log in
									</a>
								</span>";
				}
				echo "<br>
				<br>
				<p id=\"beschrijving\">Hier kan een beschrijving</p>";
			?>
		</div>
	</body>
</html>