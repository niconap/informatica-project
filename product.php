<!DOCTYPE html>
<html>
	<head>
		<title>Tim's Art - Account</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css">
		<link href="./css/product.css?v=30" rel="stylesheet" type="text/css">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php 
			include_once "navigation.php";
			include_once "./core/dbconnectie.php";
		?>
		<div id="content">
			<?php
				if(!$_GET['productnummer']){
					header("location: index.php");
				}

				$productnummer = substr($_GET['productnummer'], strrpos($_GET['productnummer'], 'r') + 1, 1);

				$sql = 'SELECT * FROM producten WHERE productnummer'.$productnummer;
				$resultaat = $db->query($sql);
				$row = $resultaat->fetch(SQLITE3_NUM);

				echo '<img src="./images/'.$row["productafbeelding"].'">
				<h2>'.$row["productnaam"].'</h2>
				<p>Prijs: '.$row["prijs"].'</p>
				<br>';

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