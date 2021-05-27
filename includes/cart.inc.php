<?php
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

include_once "./core/dbconnectie.php";

#het opvragen van de items in de winkelwagen
$sql = 'SELECT * FROM winkelwagen, producten WHERE winkelwagen.productnummer=producten.productnummer AND klantnummer='.$_SESSION["klantnummer"];
$resultaat = $db->query($sql);


#het opvragen van het aantal items in de winkelwagen
$sqlAantal = 'SELECT count(productnummer) FROM winkelwagen WHERE klantnummer='.$_SESSION["klantnummer"];
$resultaatAantal = $db->query($sqlAantal);

$sqlrow = $resultaatAantal->fetch(SQLITE3_NUM);
$aantalItems = $sqlrow['count(productnummer)'];


#verwijderen uit winkelwagen
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

function bestel($db, $klantnummer){
	$sqlbestel = 'SELECT * FROM winkelwagen WHERE klantnummer=:klantnummer';

	if(!$stmt = $db->prepare($sqlbestel)) {
		header("location: ../cart.php");
		exit;
	}

	$stmt->bindParam(':klantnummer', $klantnummer);
	$stmt->execute();
	
	while($row = $stmt->fetch(SQLITE3_NUM)) {
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


function editInfo($db, $kolom, $waarde, $klantnummer) {
	$sqledit = 'UPDATE klanten SET '.$kolom.'=:waarde WHERE klantnummer=:klantnummer';

	if(!$stmt = $db->prepare($sqledit)) {
		header("location: ../index.php");
		exit;
	}
	
	$stmt->bindParam(':waarde', $waarde);
	$stmt->bindParam(':klantnummer', $klantnummer);

	$stmt->execute();
	$stmt=null;

	$_SESSION[$kolom] = $waarde;

	header("location: ../order.php");
	exit;
}