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

		echo '<div id="cartcontent">
            	<h2>Winkelwagentje</h1>
            	<p></p>
        	</div>';
	?>
</body>
</html>