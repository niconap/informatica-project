<?php
# Stuurt iemand terug als diegene niet ingelogd is
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

# Vraagt de items op uit de "bestellingen" tabel uit de database
$sql = 'SELECT bestelnummer, besteldatum, productnaam, prijs, productafbeelding, aantal FROM bestellingen, producten WHERE klantnummer='.$_SESSION["klantnummer"].' AND producten.productnummer=bestellingen.productnummer';
$resultaat = $db->query($sql);


# Zorgt voor het opvragen van het aantal items in de tabel bestellingen
$sqlAantal = 'SELECT count(bestelnummer) FROM bestellingen WHERE klantnummer='.$_SESSION["klantnummer"];
$resultaatAantal = $db->query($sqlAantal);

$sqlrow = $resultaatAantal->fetch(SQLITE3_NUM);
$aantalItems = $sqlrow['count(bestelnummer)'];