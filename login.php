<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="./css/style.css?v=2" rel="stylesheet" type="text/css">
	<link href="./css/login.css?v=3" rel="stylesheet" type="text/css">
</head>
<body>

<?php
	include_once "navigation.php";
?>

<section>
	<div id="loginhok">
		<div id="logininhoud">
			<h1>Log in</h1>
			<form action="includes/login.inc.php" method="post">
				<br>
				<label>Vul uw emailadres in:</label>
				<br>
				<input type="email" name="emailadres" placeholder="Emailadres" required>
				<br><br>
				<label>Vul uw wachtwoord in:</label>
				<br>
				<input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
				<br><br>
				<button id="login" type="submit" name="login">Log in</button>
				<br><br>
				Klik <a href="registratie.php">hier</a> als je nog geen account hebt
			</form>
		</div>
		<br>
		<p id="aanmaak">Klik <a href="registratie.php">hier</a> als je nog geen account hebt</p>
	</div>
</section>

<?php
	if (isset($_GET["error"])) {
		if ($_GET["error"] == "leeg") {
			echo "<p>Vul alle velden in!</p>";
		} elseif ($_GET["error"] == "verkeerdeLogin") {
			echo "<p>Emailadres of wachtwoord is onjuist, probeer opnieuw!</p>";
		}
	}
?>

</body>
</html>