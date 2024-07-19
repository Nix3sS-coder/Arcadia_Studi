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
        <link rel="stylesheet" href="CSS/Detail_Habitat.css">
    </head>
    <body onload="menu(4)">
        <?php include('./Arcadia.html'); ?>
    <?php include('navbar.html');
            
                $habitat=$_GET['habitat'];
                ?>
        <h2 class="bgelt">
            <?php include('PHP/Model/Habitat_nom_from_ID.php');
            echo $nomHabitat[0]['Nom'];
            ?>
            
        </h2> <!-- A modifier-->
        <?php  

        include("PHP/Vue/Habitat_detail_habitat.php"); ?>




        <?php include('footer.html') ?>
    </body>
</html>