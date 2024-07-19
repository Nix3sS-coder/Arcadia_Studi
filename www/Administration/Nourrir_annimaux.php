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
        <link rel="stylesheet" href="CSS/Nourrir_annimaux.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
        <h2 class="bgelt"> Nourrir les Animaux</h2>
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>

            <section id="choixAnimal" class="bgelt">
                <article id="choixan">
                        <?php include("PHP/Controller/affichage_choix_hab_animaux.php"); ?>
                    </article>
                    <button onclick="choixanimal()">Choisir l'animal</button>
            </section>



            <section id="Nourrir">
                <article id="recapveto">

                </article>
                <hr>
                <article id="nourrirDetail" class="bgelt">
                    <div>
                        <p>Choix de la date</p>
                        <input id="date" type="date"></input>
                    </div>
                    <div>
                        <p>Choix de l'Heure</p>
                        <input id="hour" type="time"></input>
                    </div>
                    <div>
                        <p>Choix du gramamge</p>
                        <input id="grammage" placeholder="grammage"></input>
                    </div>
                    <div>
                        <p>Choix de la nourriture</p>
                        <input id="nourriture" placeholder="nourriture" ></input>
                    </div>
                    <button onclick="nourrirAnimal()">Nourrir Animal</button>
                </article>
            </section>



            <script src="JS/call_API.js"></script>
            <script src="JS/Nourrir_annimaux.js"></script> 






            <?php    
                include('../footer.html');

            ?>

    </body>
</html>
