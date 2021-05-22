<?php
require_once "./core/dbconnectie.php";

$sql = 'SELECT * FROM producten';

$resultaat = $db->query($sql);


#toevoegen aan winkelwagen
function addCart($db, $klantnummer, $productnummer) {
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