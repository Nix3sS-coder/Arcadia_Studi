<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Paul LESAGE" />
        <meta name="description" content="ARCADIA le zoo de broceliande" />
        <meta name="keywords" content="ARCADIA, ZOO, Annimaux, broceliande " />
        <meta name="reply-to" content="studiarcadia@gmail.com" />
        <link rel="start" title="Accueil" href="accueil.html" />
        <title>ARCADIA ZOO</title>
        <link rel="icon" type="image/gif" href="Assets/icon.png" />
        <link rel="stylesheet" href="CSS/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body onload="menu(5)">
    <?php include('navbar.html');
            include('./Arcadia.html') ?>
        <h2 class="bgelt">Services</h2>
        
        <?php

            include('PHP/Model/infos_services.php');
            for($i=0;$i<count($services);$i++){
                echo "<article class=\"bgelt\">";
                echo "<h3>".$services[$i]["Nom"]."</h3>";
                echo "<p>".$services[$i]["Description"]."</p>";
            echo "</article>
    
            <hr>";
            }

        ?>

        <?php include('footer.html') ?>
    </body>
</html>
