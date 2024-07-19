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
        <link rel="stylesheet" href="CSS/Animaux_ajout.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
    
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
                ?>


        <article id="habitat1" class="bgelt">
        <input type="text" placeholder="Prenom" id="nom1">
        <input type="text" placeholder="race" id="race1">

        <?php

        include("PHP/Model/recup_liste_habitat.php");

        echo '<select name="habitat" id="selecthabitat1">';

        foreach($habitat as $hab){

                echo '<option value="'.$hab['ID'].'">'.$hab['Nom'].'</option>';
            }
           

        echo '</select>';
    ?>

        <div id="lstimg1">
            <button id="addimg" onclick="addimg('1')"> Add IMG </button>
        </div>
        
        <button onclick="add('1')"> Ajouter </button>
        </article>





            <?php    
                include('PHP/Vue/choose_and_send_img.php');
                include('../footer.html');

            ?>
    <script src="JS/call_API.js"></script>
    <script src="JS/Upload_IMG.js"></script>
    <script src="JS/Animaux_ajout.js"></script>
    </body>
</html>
