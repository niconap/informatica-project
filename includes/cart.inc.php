<?php
# Stuurt iemand terug als diegene niet ingelogd is
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

# Vraagt de items op in de winkelwagen
$sql = 'SELECT * FROM winkelwagen, producten WHERE winkelwagen.productnummer=producten.productnummer AND klantnummer='.$_SESSION["klantnummer"];
$resultaat = $db->query($sql);


# Vraagt het aantal items op in de winkelwagen
$sqlAantal = 'SELECT count(productnummer) FROM winkelwagen WHERE klantnummer='.$_SESSION["klantnummer"];
$resultaatAantal = $db->query($sqlAantal);

$sqlrow = $resultaatAantal->fetch(SQLITE3_NUM);
$aantalItems = $sqlrow['count(productnummer)'];


# Verwijdert het item uit de winkelwagen
function removeCart($db, $klantnummer, $productnummer) {
	$sqlverwijderen = "DELETE FROM winkelwagen WHERE klantnummer=:klantnummer AND productnummer=:productnummer";

	if(!$stmt = $db->prepare($sqlverwijderen)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->bindParam(':klantnummer', $klantnummer);
	$stmt->bindParam(':productnummer', $productnummer);

	$stmt->execute();
	$stmt=null;

	header("location: ../cart.php?verwijderd");
	exit;
}

# Voegt product en klant toe aan de tabel bestellingen tabel in de database
function bestel($db, $klantnummer){
	$sqlbestel = 'SELECT * FROM winkelwagen WHERE klantnummer=:klantnummer';

	if(!$stmt = $db->prepare($sqlbestel)) {
		header("location: ../cart.php");
		exit;
	}

	$stmt->bindParam(':klantnummer', $klantnummer);
	$stmt->execute();
	
	while($row = $stmt->fetch(SQLITE3_NUM)) {
		# Haalt het product uit de winkelwagen bij iedereen
		$sqldel = 'DELETE FROM winkelwagen WHERE productnummer=:productnummer';
		if(!$stmtitem = $db->prepare($sqldel)) {
			header("location: ../cart.php");
			exit;
		}
		$stmtitem->bindParam(':productnummer', $row["productnummer"]);

		$stmtitem->execute();
		$stmtitem=null;

		# Wijzigt de voorraad naar 0
		$sqledit = 'UPDATE producten SET voorraad=0 WHERE productnummer=:productnummer';
		if(!$stmtitem = $db->prepare($sqledit)) {
			header("location: ../cart.php");
			exit;
		}
		$stmtitem->bindParam(':productnummer', $row["productnummer"]);

		$stmtitem->execute();
		$stmtitem=null;
		
		# Voegt product toe aan bestellingen
		$sqlbestelitem = 'INSERT INTO bestellingen (besteldatum, productnummer, klantnummer) VALUES (?, ?, ?)';

		if(!$stmtitem = $db->prepare($sqlbestelitem)) {
			header("location: ../cart.php");
			exit;
		}
		$stmtitem->bindParam(1, date("H:i:s d-m-Y"));
		$stmtitem->bindParam(2, $row["productnummer"]);
		$stmtitem->bindParam(3, $klantnummer);

		$stmtitem->execute();
		$stmtitem=null;
	}

	$stmt=null;
	header("location: ./pmsucces.php");
	exit;
}