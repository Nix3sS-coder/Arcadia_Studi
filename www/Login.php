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
        <link rel="stylesheet" href="CSS/login.css">
    </head>
    <body onload="menu(2)">
        <?php include('navbar.html');
            include('./Arcadia.html') ?>
        <h2>Login</h2>

        <?php
        if(isset($_GET['status'])){
            if($_GET['status']="error"){
                echo " <h3> Le couple e-mail / mot de passe n'est pas valide</h3>";
            }

        }
        ?>

        <article>
        <input type="input" id="mail" placeholder="Mail">
        <input type="input" id="pwd" placeholder="Password">
        <button onclick="login()">Login</button>
        </article>
        <script src="JS/login.js"></script>
        <?php include('footer.html') ?>
    </body>
</html>
