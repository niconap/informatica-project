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
        include_once "navigation.php";
        include_once "./core/dbconnectie.php";
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
                        <form method="GET">
                            <input class="invisbleInput" type="productnummer" placeholder="productnummer" name="productnummer">
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
		if (isset($_GET["productnummer"])) {
			$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
			# Haalt het productnummer uit de url
			$productnummer = substr($url, strrpos($url, '&') + 1, 1);		
		    $klantnummer = $_SESSION["klantnummer"];

		    addCart($db, $klantnummer, $productnummer);
		}
    ?>
</body>
</html>