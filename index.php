<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/index.css?v=4" rel="stylesheet" type="text/css">
  <link href="./css/style.css" rel="stylesheet" type="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tim's Art</title>
</head>
<body>
    <?php 
        # Zorgt voor het oproepen van de navigatie
        include_once "navigation.php";
        require_once "./core/dbconnectie.php";
        require_once "./includes/index.inc.php";

        # Zorgt voor het maken van de landing image
        echo '<div id="landingtext">
            <h1 id="title">TIM SMELIK</h1>
            <h3>Epoxy Kunstenaar</h3>
            <a href="#ourcollection" id="shopnow">Shop Nu</a>
        </div>';

        # Zorgt voor het maken van de titel van de shop
        echo '<div id="ourcollection">
            <h3>ONZE COLLECTIE</h3>
            <p>De collectie van Tim Smelik bestaat uit zijn eigen ideëen en creativiteit.</p>
        </div>';

        echo '<div id="shop">';
        class Shopitem{
            public $itemimg;
            public $itemdescription;
            public $itemprice;
            public $itemid;

            public function getItem() {
                if (isset($_SESSION["klantnummer"])) {
                echo '<div class="item">
                        <a href="product.php?product='.$this->itemdescription.'">
                            <img src="'.$this->itemimg.'" class="itemimg" />
                            <span class="itemdescription">'.$this->itemdescription.'</span>
                        </a>
                        <span class="itemprice">'.$this->itemprice.'</span>
                        <form method="POST"><a type="submit" id="button" name="'.$this->itemid.'">In winkelmandje</a></form>
                    </div>';
                } else {
                    echo '<div class="item">
                        <a href="product.php?product='.$this->itemdescription.'">
                            <img src="'. $this->itemimg .'" class="itemimg" />
                            <span class="itemdescription">'. $this->itemdescription .'</span>
                        </a>
                        <span class="itemprice">'. $this->itemprice .'</span>
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

            public function __construct($itemimg, $itemdescription, $itemprice, $itemid) {
                $this->itemimg = $itemimg;
                $this->itemdescription = $itemdescription;
                $this->itemprice = $itemprice;
                $this->itemid = $itemid;
            }
        }


        # Deze array wordt vervangen door wat we uit de database halen
        /*$array = array(
            "danser" => array("img" => "./images/danser.jpg",
            "description" => "Danser",
            "price" => "€50,00",),
            "gezicht" => array("img" => "./images/Oranje-rood hoofd.jpg",
            "description" => "Oranje-rood Hoofd",
            "price" => "€50,00",),
            "purplehead" => array("img" => "./images/Paars Hoofd.jpg",
            "description" => "Paars Hoofd",
            "price" => "€50,00",),
            "puzzle" => array("img" => "./images/Puzzel.jpg",
            "description" => "Puzzel",
            "price" => "€50,00",),
        );
        
        foreach ($array as $element) {
            $item = new Shopitem($element["img"], $element["description"], $element["price"]);
            echo $item->getItem();
        }*/

        # De vervangende manier voor de database
        while($row = $resultaat->fetch(SQLITE3_NUM)) {
            $itemid = $row["productnummer"];
            $productnaam = $row["productnaam"];
			$prijs = $row["prijs"];
            $productafbeelding = $row["productafbeelding"];
            $productbeschrijving = $row["productbeschrijving"];

            $array = array(
                $productnaam => array(
                "img" => "./images/$productafbeelding",
                "description" => "$productbeschrijving",
                "price" => "$prijs",
                "id" => "$itemid")
            );

            foreach($array as $element) {
                $item = new Shopitem($element["img"], $element["description"], $element["price"], $element["id"]);
                echo $item->getItem();
            }
        }

        $klantnummer = $_SESSION["klantnummer"];
        if(isset($_POST["productnummer"])) {
            addCart($db, $klantnummer, $productnummer);
        }

        echo '</div>';
    ?>
</body>
</html>