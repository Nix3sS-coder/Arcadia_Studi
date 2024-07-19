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
        <link rel="icon" type="image/gif" href="/Assets/icon.png" />
        <link rel="stylesheet" href="CSS/all.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/Gestion_du_Zoo.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
    
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>
            <div>
                <button onclick="document.location='animaux_gestion.php'">Gestion des Animaux</button>
                <button onclick="document.location='Habitat_gestion.php'">Gestion des Habitats</button>
                <button onclick="document.location='Horaire_gestion.php'">Gestion des Horaires</button>
            </div>









            <?php    
                include('../footer.html');

            ?>

    </body>
</html>
