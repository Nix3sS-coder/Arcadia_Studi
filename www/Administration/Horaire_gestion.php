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
        <link rel="stylesheet" href="CSS/Horaire_gestion.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
            <article class="bgelt">
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                include('PHP/Vue/Horaire_detail.php');
                ?>












            <button onclick="modif()">Modifier les Horaires </button>
        </article>
            <?php    
                include('../footer.html');

            ?>


        <script src="JS/call_API.js"></script>
        <script src="JS/Horaire_gestion.js"></script>
    </body>
</html>