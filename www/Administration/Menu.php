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
        <link rel="stylesheet" href="CSS/menu.css">
    </head>
    <body onload="menu(2)">
    <?php include($_SERVER['DOCUMENT_ROOT'] .'/Arcadia.html'); ?>
        <?php
        include('PHP/Controller/Verif_Administration.php');
        check(1,2,3);
        echo "<div>";
        if($user_data['role']==1){
            //Admin

            echo "<button onclick=\"document.location='Gestion_du_Zoo.php'\">Gestion du ZOO</button>";
            
            echo "<button onclick=\"document.location='Stats.php'\">Stats</button>";

            echo "<button onclick=\"document.location='Utilisateur_gestion.php'\">Utilisateurs</button>";

            echo "<button onclick=\"document.location='Comm_habitat_visu.php'\">Vu sur les commentaire Habitat</button>";


        }
        elseif($user_data['role']==2){
            //veto
            echo "<button onclick=\"document.location='CR_redaction.php'\">Rediger un CR</button>";

            echo "<button onclick=\"document.location='Comm_habitat_redaction.php'\">Rediger un Commentaire sur un habitat</button>";
        }
        
        if($user_data['role']==1 || $user_data['role']==2){
            echo "<button onclick=\"document.location='Nourriture_historique.php'\">Historique Animaux nourrit</button>";

            echo "<button onclick=\"document.location='CR_Historique.php'\">Historique CR veterinaire</button>";

        }
        if($user_data['role']==3 || $user_data['role']==1){
            //employee
            echo "<button onclick=\"document.location='Services_Gestion.php'\">Services</button>";

            echo "<button onclick=\"document.location='Gestion_avis.php'\">Gestion des Avis</button>";

            echo "<button onclick=\"document.location='Nourrir_annimaux.php'\">Nourrir les annimaux</button>";

        }
        echo "</div>";

        include('../navbar.html')
        ?>
    </body>
</html>
