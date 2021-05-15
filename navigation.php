<?php 
#start de sessie om te kijken of iemand ingelogd is
session_start();

#hier wordt de navigatie gemaakt
echo'<nav>
        <img id="logo" src="./images/logo.png">
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./index.php#ourcollection">Shop</a></li>
            <li><a href="./about.php">Over</a></li>
            <li><a href="#">More</a></li>
        </ul>
        <img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />
    </nav>';

/*
if (isset($_SESSION["klantnummer"])) {
    echo '<a href="./account.php">Account</a>';
    echo '<img alt="Shopping cart" id="cart" src="./images/shoppingcart.svg" />';
} else {
    echo '<a href="./login.php">Log in</a>';
}
*/

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