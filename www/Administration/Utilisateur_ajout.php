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
        <link rel="stylesheet" href="CSS/Utilisateur_ajout.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
    
            <?php
                include('PHP/Controller/Verif_Administration.php');
                check(1);
                include($_SERVER['DOCUMENT_ROOT'] .'/navbar.html');?>

            <h2 class="bgelt"> Ajout d'Utilisateur </h2>
            
            <section class="bgelt">
                <select name="role" id="role-select">
                    <option value="">--Please choose an option--</option>
                    <option value="2">Veterinaire</option>
                    <option value="3">Employee</option>
                </select>

                <input id="mail" placeholder="Mail User"></input> 
                <input id="PWD" placeholder="Mot de passe User"></input> 

                <button onclick="createAccount()"> Creer le compte en envoyer le mail</button>
        </section>

            <?php    
                include('../footer.html');

            ?>
    <script src="JS/call_API.js"></script>
    <script src="JS/Utilisateur_ajout.js"></script>
    </body>
</html>
