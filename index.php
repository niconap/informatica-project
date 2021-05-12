<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./index.css" rel="stylesheet" type="text/css">
  <link href="./style.css" rel="stylesheet" type="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tim's Art</title>
</head>
<body>
    <?php 
        # Zorgt voor het maken van de navigatie
        echo '<nav>
            <p>Tim\'s Art</p>
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#ourcollection">Shop</a></li>
            <li><a href="./about.php">Over</a></li>
            <li><a href="#">More</a></li>
            </ul>
            <img alt="Shopping cart" src="./images/shoppingcart.svg" />
        </nav>';

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

            public function getItem() {
                echo '<div class="item">
                        <img src="'. $this->itemimg .'" class="itemimg" />
                        <span class="itemdescription">'. $this->itemdescription .'</span>
                        <span class="itemprice">'. $this->itemprice .'</span>
                        <a>In winkelmandje</a>
                    </div>';
            }

            public function __construct($itemimg, $itemdescription, $itemprice) {
                $this->itemimg = $itemimg;
                $this->itemdescription = $itemdescription;
                $this->itemprice = $itemprice;
            }
        }

        # Deze array wordt vervangen door wat we uit de database halen
        $array = array(
            "dancer" => array("img" => "./images/dancer.jpg",
            "description" => "Danser",
            "price" => "€50,00",),
            "face" => array("img" => "./images/face.jpg",
            "description" => "Oranje-rood Hoofd",
            "price" => "€50,00",),
            "purplehead" => array("img" => "./images/purplehead.jpg",
            "description" => "Paars Hoofd",
            "price" => "€50,00",),
            "puzzle" => array("img" => "./images/puzzle.jpg",
            "description" => "Puzzel",
            "price" => "€50,00",),
        );
        
        foreach ($array as $element) {
            $item = new Shopitem($element["img"], $element["description"], $element["price"]);
            echo $item->getItem();
        }

        echo '</div>';

        // Manier om verbinding te maken met een database
        // $dir = 'sqlite:database.sqlite';
        // $dbh = new PDO($dir) or die("Cannot open database");
        // $query = 'SELECT name from data WHERE age="16"';
        // foreach ($dbh->query($query) as $row) {
        //    echo $row[0];
        // }
        // $dbh = null;
    ?>
</body>
</html>