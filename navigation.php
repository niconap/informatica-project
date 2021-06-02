<?php
# Start de sessie om te kijken of iemand ingelogd is
session_start();

include_once "./core/dbconnectie.php";

# Hier wordt de navigatie gemaakt, deze verschild als de klant wel of niet is ingelogd
if (isset($_SESSION["klantnummer"])) {
    echo'<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
                <li><a class="heading" href="./index.php#">Home</a></li>
                <li><a class="heading" href="./index.php#ourcollection">Shop</a></li>
                <li><a class="heading" href="./about.php">Over</a></li>
                <li><a class="heading" href="./account.php">Account</a></li>
            </ul>
            <a href="./cart.php"><img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg"></a>
        </nav>';
} else {
    echo'<nav>
            <img id="logo" src="./images/logo.png">
            <ul>
                <li><a class="heading" href="./index.php">Home</a></li>
                <li><a class="heading" href="./index.php#ourcollection">Shop</a></li>
                <li><a class="heading" href="./about.php">Over</a></li>
                <li><a class="heading"  href="./login.php">Log in</a></li>
            </ul>
            <a id="cartlink" href="./cart.php"><img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg"></a>
        </nav>';
}