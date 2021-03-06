<?php
# Checkt of de voorraad groter dan 1 is en gaat dan naar de productpagina als dit waar is
function checkVoorraad($db, $productnummer) {
	$sqlcheck = 'SELECT voorraad FROM producten WHERE productnummer=:productnummer';
	
	if(!$stmt = $db->prepare($sqlcheck)) {
		header("location: ../index.php?henk");
		exit;
	}

	$stmt->bindParam(':productnummer', $productnummer);
	$stmt->execute();
	$row = $stmt->fetch();
	$voorraad = $row["voorraad"];

	$stmt=null;

	if($voorraad >= 2) {
		echo '<script>window.location.href="./product.php?productnummer='.$productnummer.'"</script>';
		exit;
	} else {
		# Haalt het klantnummer uit de sessie
		$klantnummer = $_SESSION["klantnummer"];

		# Wanneer de voorraad groter dan 1 is ga je eerst al naar de productpagina
		$aantal = 1;

		# Stopt alle informatie in de functie om het in het winkelmandje te krijgen
		addCart($db, $klantnummer, $productnummer, $aantal);

		exit;
	}
}

# Voegt het toe aan de winkelwagen
function addCart($db, $klantnummer, $productnummer, $aantal) {
	# Checkt of het product niet al in het winkelwagentje zit
	$sqlcheck = 'SELECT * FROM winkelwagen WHERE klantnummer='.$klantnummer.' AND productnummer='.$productnummer;
	
	if(!$stmt = $db->prepare($sqlcheck)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->execute();
	$row = $stmt->fetch();

	if($row["productnummer"] == $productnummer) {
		exit;
	}

	$stmt=null;

	# Als het product niet in het winkelwagentje zit wordt het toegevoegd
	$sqltoevoegen = 'INSERT INTO winkelwagen (klantnummer, productnummer, aantal) VALUES (:klantnummer, :productnummer, :aantal)';

	if(!$stmt = $db->prepare($sqltoevoegen)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->bindParam(1, $klantnummer);
	$stmt->bindParam(2, $productnummer);
	$stmt->bindParam(3, $aantal);

	$stmt->execute();
	$stmt=null;

	exit;
}