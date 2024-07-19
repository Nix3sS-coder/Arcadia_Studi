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
        <link rel="stylesheet" href="CSS/contact.css">
    </head>
    <body onload="menu(1)">
    <?php include('navbar.html');
            include('./Arcadia.html') ?>
        <h2>Contact</h2>

        <article id="contact">
            <h3>Formulaire de Contact</h3>
            <input type="input" id="Titre" placeholder="Titre">
            <input type="input" id="Description" placeholder="Description">
            <input type="input" id="Mail" placeholder="Mail">
            <button onclick="contact()"> Envoyer votre message au zoo</button>
        </article>

        <hr>

        <article id="Avis">
            <h3>Partager votre Avis</h3>
            <input type="input" id="Pseudo" placeholder="Pseudo">
            <input type="input" id="AvisUser" placeholder="Avis">
            <button onclick="avis()"> Envoyer votre avis</button>
        </article>


        <?php include('footer.html') ?>
        <script src="JS/contact.js"></script>
    </body>
</html>
