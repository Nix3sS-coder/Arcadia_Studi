<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Paul LESAGE" />
    <meta name="description" content="ARCADIA le zoo de Brocéliande" />
    <meta name="keywords" content="ARCADIA, ZOO, Animaux, Brocéliande" />
    <meta name="reply-to" content="mailto:Arcadiazoo@gmail.com" />
    <link rel="start" title="Accueil" href="accueil.html" />
    <title>ARCADIA ZOO</title>
    <link rel="icon" type="image/gif" href="image/favicon.gif" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/animaux_gestion.css">
</head>
<body onload="menu(2)">
<?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>

    <?php
    include('PHP/Controller/Verif_Administration.php');
    check(1);
    include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');
    ?>

    <button onclick="document.location='Animaux_ajout.php'">Ajouter</button>

    <?php
    include('PHP/Vue/detail_animal.php');
    include('PHP/Vue/choose_and_send_img.php');
    include('../footer.html');
    ?>

    <script src="JS/call_API.js"></script>
    <script src="JS/Upload_IMG.js"></script>
    <script src="JS/animaux_gestion.js"></script>
       
</body>
</html>
