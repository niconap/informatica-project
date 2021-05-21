<?php
if (!isset($_SESSION["klantnummer"])) {
	header("location: ../index.php");
}

require_once "./core/dbconnectie.php";

$sql = 'SELECT * FROM winkelwagen, producten WHERE winkelwagen.productnummer=producten.productnummer AND klantnummer='.$_SESSION["klantnummer"];

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

	header("location: ../login.php");
	exit;
}