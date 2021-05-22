<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/style.css" rel="stylesheet" type="text/css">
  <link href="./css/about.css" rel="stylesheet" type="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tim's Art - Over</title>
</head>
<body>
    <?php 
        # Zorgt voor het oproepen van de navigatie
        include_once "navigation.php";

        # Zorgt voor de informatie op de pagina
        echo '<div id="aboutcontent">
            <h2>OVER TIM</h2>
            <p id="description">Tim Smelik is al jaren prachtige kunstwerken aan het maken met een bijzonder materiaal: epoxy. Hij giet prachtige vormen of buigt ze zo dat er een figuur te zien wordt. Het mixen van materialen zoals een stuk hout erbij of stukken metaal is niks nieuws en dit wordt vaak gedaan om een speciaal effect te geven aan het kunstwerk.</p>
        </div>
        <img id="aboutimg" src="./images/redlamp.jpg">';

        # Zorgt voor het maken van de informatie bij contact
        echo '<div id="contact">
            <div id="info">
            <p>Tim Smelik</p>
            <br><br>
            <p>
                Adres:   32a Herenstraat
                <br>
                Breukelen, 3621 AR
                <br>
                Telefoon:   <a href="tel:123-456-7890">123-456-7890</a>
                <br>
                E-mail:  <a href="mailto:timart@smelik.com">timart@smelik.com</a>
            </p>
            <br><br>
            <p>
                MA - VR:  7am - 10pm
                <br>
                ZA:   8am - 10pm
                <br>
                ZO:   8am - 11pm
            </p>
        </div>';
    ?>
</body>
</html>