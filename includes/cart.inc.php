<?php
# Stuurt iemand terug als diegene niet ingelogd is
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

# Vraagt de items op in de winkelwagen
$sql = 'SELECT * FROM winkelwagen, producten WHERE winkelwagen.productnummer=producten.productnummer AND klantnummer='.$_SESSION["klantnummer"];
$resultaat = $db->query($sql);


# Vraagt het aantal items op in de winkelwagen
$sqlAantal = 'SELECT count(*) FROM winkelwagen WHERE klantnummer='.$_SESSION["klantnummer"];
$resultaatAantal = $db->query($sqlAantal);
$rowAantal = $resultaatAantal->fetch(SQLITE3_NUM);
$aantalItems = $rowAantal['count(*)'];


# Verwijdert het item uit de winkelwagen
function removeCart($db, $klantnummer, $productnummer) {
	$sqlverwijderen = 'DELETE FROM winkelwagen WHERE klantnummer=:klantnummer AND productnummer=:productnummer';

	if(!$stmt = $db->prepare($sqlverwijderen)) {
		echo '<script>window.location.href="./cart.php"</script>';
		exit;
	}

	$stmt->bindParam(':klantnummer', $klantnummer);
	$stmt->bindParam(':productnummer', $productnummer);

	$stmt->execute();
	$stmt=null;

	echo '<script>window.location.href="./cart.php"</script>';
	exit;
}

# Voegt product en klant toe aan de tabel bestellingen tabel in de database
function bestel($db, $klantnummer){
	$sqlbestel = 'SELECT * FROM winkelwagen WHERE klantnummer=:klantnummer';

	if(!$stmt = $db->prepare($sqlbestel)) {
		echo '<script>window.location.href="./cart.php"</script>';
		exit;
	}

	$stmt->bindParam(':klantnummer', $klantnummer);
	$stmt->execute();
	
	while($row = $stmt->fetch(SQLITE3_NUM)) {
		# Haalt het product uit de winkelwagen bij iedereen
		$sqldel = 'DELETE FROM winkelwagen WHERE productnummer=:productnummer';
		if(!$stmtitem = $db->prepare($sqldel)) {
			echo '<script>window.location.href="./cart.php"</script>';
			exit;
		}
		$stmtitem->bindParam(':productnummer', $row["productnummer"]);

		$stmtitem->execute();
		$stmtitem=null;

		# Wijzigt de voorraad naar de voorraad min het bestelde aantal
		# Checkt het aantal in de voorraad
		$sqlVoorraad = 'SELECT voorraad FROM winkelwagen WHERE klantnummer='.$_SESSION["klantnummer"];
		$resultaatVoorraad = $db->query($sqlVoorraad);
		$rowVoorraad = $resultaatVoorraad->fetch(SQLITE3_NUM);
		$voorraad = $rowVoorraad['count'];
		$nieuweVoorraad = $voorraad - $row["aantal"];

		
		$sqledit = 'UPDATE producten SET voorraad='.$nieuweVoorraad.' WHERE productnummer=:productnummer';
		if(!$stmtitem = $db->prepare($sqledit)) {
			echo '<script>window.location.href="./cart.php"</script>';
			exit;
		}
		$stmtitem->bindParam(':productnummer', $row["productnummer"]);

		$stmtitem->execute();
		$stmtitem=null;
		
		# Voegt product toe aan bestellingen
		$sqlbestelitem = 'INSERT INTO bestellingen (besteldatum, productnummer, klantnummer, aantal) VALUES (?, ?, ?, ?)';

		if(!$stmtitem = $db->prepare($sqlbestelitem)) {
			echo '<script>window.location.href="./cart.php"</script>';
			exit;
		}
		$stmtitem->bindParam(1, date("H:i:s d-m-Y"));
		$stmtitem->bindParam(2, $row["productnummer"]);
		$stmtitem->bindParam(3, $klantnummer);
		$stmtitem->bindParam(4, $row["aantal"]);

		$stmtitem->execute();
		$stmtitem=null;
	}

	$stmt=null;
	echo '<script>window.location.href="./pmsucces.php"</script>';
	exit;
}