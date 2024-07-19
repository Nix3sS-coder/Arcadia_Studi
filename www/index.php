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
        <link href="navbar.html" rel="import" />

        <link rel="stylesheet" href="CSS/index.css">
    </head>
    <body onload="menu(3)">
    <?php include('./Arcadia.html') ?>
        <?php include('navbar.html');?>
            

        <article class="bgelt">
            <h2> Presentation </h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam, a. Eius excepturi, at tenetur alias inventore dignissimos, perferendis animi nihil numquam necessitatibus sunt amet. Officiis veritatis, nihil praesentium aut quibusdam velit eveniet expedita officia impedit ratione perferendis, fugiat provident aliquam consectetur saepe accusamus libero, necessitatibus id? Alias tenetur illum excepturi.<p>
            <div id="imgzoo"> 
                <img src="Assets/ZOO1.jpg">
                <img src="Assets/zoo2.jpg">
            </div>
        </article>

        <hr>

        <section class="bgelt">
            <h2>Habitat</h2>
            <article id="habitat">
                <?php include("PHP/Vue/Index_recup_habitat.php") ?>
            </article>
        </section>

        <hr>

        <article class="bgelt">
            <h2>Avis</h2>
            <?php include("PHP/Vue/Index_avis.php") ?>
            <button onclick="document.location.href='contact.php'">Donner son Avis</button>
        </article>

        <hr>
        <article class="bgelt">
            <h2>Horaires</h2>
            <?php include('PHP/Vue/Index_Horaire.php'); ?>
        </article>
        <?php include('footer.html'); ?>
        
    </body>
</html>
