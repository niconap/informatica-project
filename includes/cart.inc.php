<?php
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

require_once "./core/dbconnectie.php";

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