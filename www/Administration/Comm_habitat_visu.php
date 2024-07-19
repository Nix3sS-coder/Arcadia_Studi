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
        <link rel="stylesheet" href="CSS/Comm_habitat_visu.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
    
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>
        <h2 class="bgelt">Vue des commentaires d'habitat</h2>
        
        <section id="filtre" class="bgelt" >
        <?php include("PHP/Vue/Liste_habitat.php") ?>
        <div>
            <p>Ameliorable ? </p>
            <input id="ameliorable" type="checkbox"></input>
        </div>
        <button onclick="commHabFilter()">Filtrer</button>
        </section>

        <section id="lstcomm" class="bgelt">
            <?php include("PHP/Vue/Comm_habitat_detail.php") ?>
        </section>




        <script src="JS/call_API.js"></script>
        <script src="JS/Comm_habitat_visu.js"></script>


            <?php    
                include('../footer.html');

            ?>

    </body>
</html>
