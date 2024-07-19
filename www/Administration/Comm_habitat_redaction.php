<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Paul LESAGE" />
        <meta name="description" content="ARCADIA le zoo de broceliande" />
        <meta name="keywords" content="ARCADIA, ZOO, Annimaux, broceliande " />
        <meta name="reply-to" content="Arcadiazoo.gmail.com" />
        <link rel="start" title="Accueil" href="accueil.html" />
        <title>ARCADIA ZOO</title>
        <link rel="icon" type="image/gif" href="image/favicon.gif" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/Comm_habitat_redaction.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
    
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(2);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>
        <h2 class="bgelt">Redaction d'un commentaire habitat</h2>

        <section class="bgelt">
        <?php include("PHP/Vue/Liste_habitat.php") ?>
        
            <textarea id="avis" placeholder="Donner votre Avis"></textarea>
            <input id="etat" placeholder="Donner votre avis sur l'état"></input>
            <div>
                <p> L'habitat est ameliorable ? </p>
                <input id="amelioration" type="checkbox"></input>
            </div>
            <button onclick="sendcomm()">Envoyer votre avis</button>

        </section>




        <script src="JS/call_API.js"></script>
        <script src="JS/Comm_habitat_redaction.js"></script>


            <?php    
                include('../footer.html');

            ?>

    </body>
</html>
