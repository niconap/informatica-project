<?php 
#start de sessie om te kijken of iemand ingelogd is
session_start();

#hier wordt de navigatie gemaakt, deze verschild als de klant wel of niet is ingelogd
if (isset($_SESSION["klantnummer"])) {
    echo'<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php#ourcollection">Shop</a></li>
                <li><a href="./about.php">Over</a></li>
                <li><a href="./account.php">Account</a></li>
            </ul>
            <img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />
        </nav>';
} else {
    echo'<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php#ourcollection">Shop</a></li>
                <li><a href="./about.php">Over</a></li>
                <li><a href="./login.php">Log in</a></li>
            </ul>
            <img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />
        </nav>';
}


/* 
ABOUT.PHP
echo '<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./index.php#ourcollection">Shop</a></li>
            <li><a href="#">Over</a></li>
            <li><a href="#">More</a></li>
            </ul>
            <img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />
        </nav>';
INDEX.PHP
echo '<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#ourcollection">Shop</a></li>
            <li><a href="./about.php">Over</a></li>
            <li><a href="#">More</a></li>
            </ul>
            <img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />
        </nav>';
*/