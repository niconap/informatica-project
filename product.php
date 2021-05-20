<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Account</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/product.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php 
			include_once "navigation.php";
		?>
		<div id="content">
			<?php
				$product = $_GET['product'];
				echo "<img src=\"images/". $product .".jpg\">
				<h2>".$product."</h2>
				<p>Prijs: onbekend</p>
				<br>
				<a>In winkelmandje</a>
				<br>
				<br>
				<p id=\"beschrijving\">Hier kan een beschrijving</p>";
			?>
		</div>
	</body>
</html>