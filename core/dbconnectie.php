<?php

$db = new PDO("sqlite:./core/database.sqlite", '', '', array(PDO::ATTR_PERSISTENT => TRUE));

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	