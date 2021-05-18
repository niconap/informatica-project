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

/*
if($aantalItems > 0) {
	while($row = $resultaat->fetch(SQLITE3_NUM)) {
		//hier verder gaan
	}
}
*/