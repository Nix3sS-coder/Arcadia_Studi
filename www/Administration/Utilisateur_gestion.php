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
        <link rel="stylesheet" href="CSS/Utilisateur_gestion.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');?>

        <h2 class="bgelt"> Gestion des Utilisateurs </h2>
        <button onclick="document.location='Utilisateur_ajout.php'"> Ajout User</button>
        <section>
            <?php include('PHP/Vue/detail_user.php') ?>
        </section>
            <?php    
                include('../footer.html');

            ?>

        <script src="JS/call_API.js"></script>
        <script src="JS/Utilisateur_gestion.js"></script>

    </body>
</html>