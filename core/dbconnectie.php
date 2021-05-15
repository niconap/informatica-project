<?php

$db = new PDO("sqlite:../../www\database.sqlite");

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	