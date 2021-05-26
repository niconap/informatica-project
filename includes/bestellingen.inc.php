<?php
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

require_once "./core/dbconnectie.php";

#het opvragen van de items in de tabel
$sql = 'SELECT bestelnummer, besteldatum, productnaam, prijs, productafbeelding FROM bestellingen, producten WHERE klantnummer='.$_SESSION["klantnummer"].' AND producten.productnummer=bestellingen.productnummer';
$resultaat = $db->query($sql);


#het opvragen van het aantal items in de tabel bestellingen
$sqlAantal = 'SELECT count(bestelnummer) FROM bestellingen WHERE klantnummer='.$_SESSION["klantnummer"];
$resultaatAantal = $db->query($sqlAantal);

$sqlrow = $resultaatAantal->fetch(SQLITE3_NUM);
$aantalItems = $sqlrow['count(bestelnummer)'];