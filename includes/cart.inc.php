<?php
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

require_once "./core/dbconnectie.php";

$sqlAantal = 'SELECT count(productnummer) FROM winkelwagen WHERE klantnummer='.$_SESSION["klantnummer"];
$sql = 'SELECT * FROM winkelwagen, producten WHERE winkelwagen.productnummer=producten.productnummer AND klantnummer='.$_SESSION["klantnummer"];

$resultaatAantal = $db->query($sqlAantal);
$aantalItems = $resultaatAantal->fetch(SQLITE3_NUM);

$resultaat = $db->query($sql);


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