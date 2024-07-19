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
        <link rel="stylesheet" href="CSS/habitat.css">
    </head>
    <body onload="menu(4)">
    <?php include('./Arcadia.html') ?>
    <?php include('navbar.html');?>
        <h2 class="bgelt">Habitats</h2>

        <?php include('PHP/Vue/Habitat_recup_Habitat.php');
                include('footer.html');
            ?>

    </body>
</html>
