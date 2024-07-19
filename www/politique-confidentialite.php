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

    </head>
    <body onload="menu(3)">
        <?php include("Arcadia.html");
        include("navbar.html");
         ?>
        <h2 class="bgelt">Politique de Confidentialité</h2>

        <div class="bgelt">
            <h3>Collecte des informations</h3>
            <p>Nous collectons les informations suivantes :</p>
            <ul>
                <li>Nom</li>
                <li>Prénom</li>
                <li>Adresse postale</li>
                <li>Adresse électronique</li>
                <li>Numéro de téléphone</li>
                <li>Informations de connexion (pour les utilisateurs administrateurs, vétérinaires et employés)</li>
            </ul>
        </div>

        <div class="bgelt">
            <h3>Utilisation des informations</h3>
            <p>Les informations que nous collectons sont utilisées pour :</p>
            <ul>
                <li>Améliorer notre service client et répondre aux demandes</li>
                <li>Gérer les comptes utilisateurs</li>
                <li>Envoyer des emails périodiques (si l'utilisateur a donné son consentement)</li>
                <li>Gérer les commentaires et les avis</li>
            </ul>
        </div>

        <div class="bgelt">
            <h3>Partage des informations</h3>
            <p>Nous ne vendons, n'échangeons et ne transférons pas vos informations personnelles à des tiers sans votre consentement, sauf si requis par la loi.</p>
        </div>

        <div class="bgelt">
            <h3>Sécurité des informations</h3>
            <p>Nous mettons en œuvre une variété de mesures de sécurité pour préserver la sécurité de vos informations personnelles.</p>
        </div>
        <?php include("footer.html") ?>
    </body>
</html>
