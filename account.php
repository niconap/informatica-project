<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
	<link href="./css/style.css" rel="stylesheet" type="text/css">
	<link href="./css/account.css?v=2" rel="stylesheet" type="text/css">
</head>
<body>

<?php
	include_once "navigation.php";
?>

<section>
  	<div id="accounthok">
	  	<div id="accountinhoud">
		  	<h1>Account</h1>
			<form action="includes/logout.inc.php" method="post">
				<button id="loguit" type="submit" name="loguit">Log uit</button>
			</form>
		</div>
  	</div>
</section>

</body>
</html>