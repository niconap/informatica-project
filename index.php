<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./style.css" rel="stylesheet" type="text/css">
  <link href="./index.css" rel="stylesheet" type="text/css">
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
            <img alt="Shopping cart" src="shoppingcart.svg" />
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
                echo '<div class="item">';
                echo '<div id="'. $this->itemimg .'" class="itemimg"></div>';
                echo '<span class="itemdescription">'. $this->itemdescription .'</span>';
                echo '<span class="itemprice">'. $this->itemprice .'</span>';
                echo '<a>Zie details</a>';
                echo '</div>';
            }

            public function __construct($itemimg, $itemdescription, $itemprice) {
                $this->itemimg = $itemimg;
                $this->itemdescription = $itemdescription;
                $this->itemprice = $itemprice;
            }
        }

        $array = array(
            "dancer" => array("img" => "dancer",
            "description" => "Danser",
            "price" => "€50,00",),
            "face" => array("img" => "face",
            "description" => "Oranje-rood Hoofd",
            "price" => "€50,00",),
            "purplehead" => array("img" => "purplehead",
            "description" => "Paars Hoofd",
            "price" => "€50,00",),
        );
        
        foreach ($array as $element) {
            $item = new Shopitem($element["img"], $element["description"], $element["price"]);
            echo $item->getItem();
        }

        echo '</div>'
    ?>
</body>
</html>