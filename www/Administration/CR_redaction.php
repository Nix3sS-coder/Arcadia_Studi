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
        <link rel="stylesheet" href="CSS/CR_redaction.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
        <h2 class="bgelt">Redaction compte rendu Veterinaire</h2>
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(2);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>
            <section class="bgelt">
                <article id="choixan">
                    <?php include("PHP/Controller/affichage_choix_hab_animaux.php"); ?>
                </article>
                <div>
                    <p>Date du CR</p>
                    <input type="date" id="date"></input>
                </div>

                <div>
                    <p>Etat : </p>
                    <input id="etat" placeholder="Etat"></input>
                </div>

                <div>
                    <p>Nourriture : </p>
                    <input id="nourriture" placeholder="nourriture"></input>
                </div>

                <div>
                    <p>Grammage : </p>
                    <input id="grammage" placeholder="grammage"></input>
                </div>

                <div>
                    <p>Details : </p>
                    <input id="Details" placeholder="Details"></input>
                </div>

                <button onclick="addCR()">Ajout du CR</button>
            </section>


    <script src="JS/call_API.js"></script>   
    <script src="JS/CR_redaction.js"></script>  

            <?php    
                include('../footer.html');

            ?>

    </body>
</html>
