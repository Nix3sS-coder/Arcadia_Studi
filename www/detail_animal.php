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
        <link rel="stylesheet" href="CSS/detail_animal.css">
    </head>
    <body onload="menu(4)">
    <?php include('./Arcadia.html'); ?>
    <?php include('navbar.html'); ?>
        <?php 
        $Animal = $_GET['Animal'];
        include("PHP/Model/detail_animal_infos.php");
        include('PHP/Controller/Maj_Stats.php');
        ?>
        <h2 class="bgelt"><?php echo $animaux[0]["Prenom"].", ".$animaux[0]["race"] ?> </h2> <!-- A modifier-->

        <div class="bgelt">
            <?php

            for($i=0;$i<count($photosliste[0]);$i++){
                echo "<img src=\"Assets/Ajouts/".$listphoto[$photosliste[0][$i]]['Fichier']."\">";
            }
            ?>
        </div>

        <hr>

        <article class="bgelt">
            <?php
            include("PHP/Model/Infos_animal_CR.php");?>

            <h3>Information sur l'animal</h3>
            <p><span>Etat : </span> <?php echo isset($CR[0]['etat']) ? $CR[0]['etat'] : ''; ?> </p>
            <p><span>Nourriture : </span> <?php echo isset($CR[0]['nourriture']) ? $CR[0]['nourriture'] : '';?> </p>
            <p><span>Grammage : </span> <?php echo isset($CR[0]['grammage']) ? $CR[0]['grammage'] : '';?> </p>
            <p><span>Date de passage : </span> <?php echo isset($CR[0]['date']) ? $CR[0]['date'] : '';?> </p>
            <p><span>Detail état : </span> <?php echo isset($CR[0]['details']) ? $CR[0]['details'] : ''; ?>  </p>
        </article>



        <?php include('footer.html') ?>
    </body>
</html>