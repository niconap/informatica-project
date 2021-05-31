<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="./css/style.css?v=20" rel="stylesheet" type="text/css">
  <link href="./css/about.css?v=20" rel="stylesheet" type="text/css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tim's Art - Over</title>
</head>
<body>
    <?php 
        # Zorgt voor het oproepen van de navigatie
        include_once "./navigation.php";

        # Zorgt voor de informatie op de pagina
        echo '<div id="aboutcontent">
                <h2>OVER TIM</h2>
                <p id="description">Tim Smelik werd geboren in Nederland op 2 oktober 1961. Hij woont met zijn gezin in de Parijse regio Fourqueux. Hij studeerde biologie in de wetenschap en promoveerde in 1996. Door zijn opleiding is hij gewend nieuwe technieken onder de knie te krijgen en aan te passen voor zijn eigen doeleinden. Door deze houding kan hij jongleren met onderwerpen. Nieuwsgierig van aard heeft hij in de loop van zijn artistieke avonturen een nieuwe techniek ontwikkeld. Hij vormt de epoxy, die hij verft, giet en vormt zoals hij wil. De verschillende niveaus waaruit het werk bestaat, bieden transparantie en geven het licht verschillende reflecties. Het gezicht en het menselijk lichaam zijn de belangrijkste onderwerpen van de kunstenaar voor zijn sculpturen. Tim neemt 20 tot 40 uur in beslag om ze te voltooien en af te ronden. Hij maakt ook kroonluchters en epoxylampen door glasfragmenten en LED-tape te verwerken.</p>
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