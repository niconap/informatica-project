<?php
# Maakt de connectie met de databas
$db = new PDO("sqlite:./core/database.sqlite", '', '', array(PDO::ATTR_PERSISTENT => TRUE));

# Als de website een wit scherm laat zien als je localhost hebt opgezocht (en de webserver staat aan), dan zou ik de onderstaande regel vervangen met de bovenste regel
//$db = new PDO("sqlite:../core/database.sqlite", '', '', array(PDO::ATTR_PERSISTENT => TRUE));


# Laat eventuele errors zien op de website
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	