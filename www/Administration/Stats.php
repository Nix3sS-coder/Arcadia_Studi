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
        <link rel="stylesheet" href="CSS/stats.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
        <div id="choix" class="bgelt">
            <button onclick="appearpie()">Pie</button>
            <button onclick="appearhisto()">Histrogramme</button>
        </div>
        <section class="bgelt">
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                include('PHP/Model/Stats_recup_infos.php');

                echo '<div id="pie">';
                include('PHP/Vue/pie.php');
                echo '</div>';
                echo '<div id="histogramme">';
                include('PHP/Vue/histogramme.php');
                echo '</div>';
                


            ?>
        </section>
        <?php include('../footer.html'); ?>
        <script src="JS/stats.js"></script>
    </body>
</html>
