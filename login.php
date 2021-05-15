<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

<section>
	<h2>Login</h2>
	<div class="loginhok">
		<form action="includes/login.inc.php" method="post">
			<label>Vul uw emailadres in:</label>
			<br>
			<input type="email" name="emailadres" placeholder="Emailadres" required>
			<br><br>
			<label>Vul uw wachtwoord in:</label>
			<br>
			<input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
			<br><br>
			<button type="submit" name="login">Log in</button>
		</form>
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