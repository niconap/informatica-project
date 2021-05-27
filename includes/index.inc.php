<?php
require_once "./core/dbconnectie.php";

$sql = 'SELECT * FROM producten';

$resultaat = $db->query($sql);


#toevoegen aan winkelwagen
function addCart($db, $klantnummer, $productnummer) {
	#checkt of het product niet al in het winkelwagentje zit
	$sqlcheck = 'SELECT * FROM winkelwagen WHERE klantnummer='.$klantnummer.' AND productnummer='.$productnummer;
	
	if(!$stmt = $db->prepare($sqlcheck)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->execute();
	$row = $stmt->fetch();

	if($row["productnummer"] == $productnummer) {
		header("location: ../index.php?2ekeer");
		exit;
	}

	$stmt=null;

	#als het product niet in het winkelwagentje zit wordt het toegevoegd
	$sqltoevoegen = 'INSERT INTO winkelwagen (klantnummer, productnummer) VALUES (?, ?)';

	if(!$stmt = $db->prepare($sqltoevoegen)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->bindParam(1, $klantnummer);
	$stmt->bindParam(2, $productnummer);

	$stmt->execute();
	$stmt=null;

	header("location: ../index.php?toegevoegd");
	exit;
}

#laten zien als product op de productpagina
function productShow($db, $productnummer){
	$productshow = true;
	$sql = 'SELECT voorraad FROM producten WHERE productnummer=:productnummer';

	if(!$stmt = $db->prepare($sql)) {
		header("location: ../index.php");
		exit;
	}

	$stmt->bindParam(':productnummer', $productnummer);

	$stmt->execute();
	$row = $stmt->fetch(SQLITE3_NUM);

	if ($row["voorraad"] == 0) {
		$productshow = false;
		return $productshow;
		exit;
	}

	$stmt=null;
	return $productshow;
	exit;
}