<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/index.css" rel="stylesheet" type="text/css">
  <link href="./css/style.css" rel="stylesheet" type="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tim's Art</title>
</head>
<body>
    <?php 
        # Zorgt voor het oproepen van de navigatie
        include_once "./navigation.php";

        # Het document waar we de functies vandaan halen
        include_once "./includes/index.inc.php";

        /* Zorgt voor het maken van de landing image en tekst, 
        als de gebruiker niet is ingelogd staat er dat ze een account
        moeten aanmaken of dat ze moeten inloggen */
        if (isset($_SESSION["klantnummer"])) {
        echo '<div id="landingtext">
                <h1 id="title">TIM SMELIK</h1>
                <h3>Epoxy Kunstenaar</h3>
                <a href="#ourcollection" id="shopnow">Shop nu</a>
            </div>';
        } else {
            echo '<div id="landingtext">
                    <h1 id="title">TIM SMELIK</h1>
                    <h3>Epoxy Kunstenaar</h3>
                    <p id="maakaccount">
                        <a href="./registratie.php">
                            Maak een account aan
                        </a> of 
                        <a href="login.php">
                            log in
                        </a>
                        om te shoppen
                    </p>
                </div>';
        }

        # Zorgt voor het maken van de titel van de shop
        echo '<div id="ourcollection">
                <h3>ONZE COLLECTIE</h3>
                <p>De collectie van Tim Smelik bestaat uit zijn eigen ideëen en creativiteit.</p>
            </div>';

        # Renderen van de producten
        echo '<div id="shop">';
        class Shopitem{
            public $itemimg;
            public $itemname;
            public $itemprice;
            public $itemid;

            public function getItem() {
                if (isset($_SESSION["klantnummer"])) {
                echo '<div class="item">
                        <a href="product.php?productnummer='.$this->itemid.'">
                            <img src="'.$this->itemimg.'" class="itemimg" />
                            <br><br>
                            <span class="itemname">'.$this->itemname.'</span>
                        </a>
                        <span class="itemprice">€'.$this->itemprice.'</span>
                        <form method="POST">
                            <input class="invisibleInput" name="productnummer">
                            <button type="submit" id="button" name="'.$this->itemid.'">In winkelmandje</a>
                        </form>
                    </div>';
                } else {
                    echo '<div class="item">
                            <a href="product.php?productnummer='.$this->itemid.'">
                                <img src="'. $this->itemimg .'" class="itemimg" />
                                <br><br>
                                <span class="itemname">'. $this->itemname .'</span>
                            </a>
                            <span class="itemprice">€'. $this->itemprice .'</span>
                            <span id="disabled">
								<a href="./registratie.php">
									Maak een account aan
								</a> of 
								<a href="login.php">
									log in
								</a>
							</span>
                        </div>';
                }
            }

            public function __construct($itemimg, $itemname, $itemprice, $itemid) {
                $this->itemimg = $itemimg;
                $this->itemname = $itemname;
                $this->itemprice = $itemprice;
                $this->itemid = $itemid;
            }
        }

        # Producten uit de database halen
        $sql = 'SELECT * FROM producten';
        $resultaat = $db->query($sql);
        while($row = $resultaat->fetch(SQLITE3_NUM)) {
            #checkt of het product in de voorraad is en laat het zien indien het in voorraad is
            if($row["voorraad"] == 1){
                $productnummer = $row["productnummer"];
                $productnaam = $row["productnaam"];
                $prijs = $row["prijs"];
                $productafbeelding = $row["productafbeelding"];
                $productbeschrijving = $row["productbeschrijving"];

                $array = array(
                    $productnaam => array(
                    "img" => "./images/$productafbeelding",
                    "name" => "$productnaam",
                    "price" => "$prijs",
                    "id" => "$productnummer")
                );

                foreach($array as $element) {
                    $item = new Shopitem($element["img"], $element["name"], $element["price"], $element["id"]);
                    echo $item->getItem();
                }
            }
        }
        

        # Registreert of iemand de "In winkelmandje" knop indrukt
		if (isset($_POST["productnummer"])) {
			# Maakt van de $_POST array een string
			$POST = print_r($_POST, true);
			
			# Haalt alle nummers uit de string
			$int = (int) filter_var($POST, FILTER_SANITIZE_NUMBER_INT);
						
			# Haalt het productnummer uit de nummers
			$productnummer = substr($int, 0, 1);

            # Haalt het klantnummer uit de sessie
			$klantnummer = $_SESSION["klantnummer"];

			# Stopt alle informatie in de functie om het in het winkelmandje te krijgen
			addCart($db, $klantnummer, $productnummer);
		}
    ?>
</body>
</html>