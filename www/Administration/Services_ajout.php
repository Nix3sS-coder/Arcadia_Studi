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
        <link rel="stylesheet" href="CSS/Services_ajout.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1,2);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html'); ?>
        <h2>Ajout de Service</h2>
        <section>
            <div>
                <p>Nom du Service : </p>
                <input id="Nom" placeholder="Nom"></input>
            </div>
            <div>
                <p>Description du Service : </p>
                <textarea id="Desc" placeholder="Description"></textarea>
            </div>
            <button onclick="addserv()">Ajouter le Service</button>
        </section>











            <?php    
                include('../footer.html');

            ?>
    <script src="JS/call_API.js"></script>
    <script src="JS/Services_ajout.js"></script>
    </body>
</html>
