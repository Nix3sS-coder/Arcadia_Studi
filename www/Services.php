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
    <body onload="menu(5)">
    <?php include('navbar.html');
            include('./Arcadia.html') ?>
        <h2 class="bgelt">Services</h2>
        
        <?php




            try {
                include('PHP/Model/Infos_services.php');
                
                // Vérifiez si $services est défini et non vide
                if (isset($services) && is_array($services) && count($services) > 0) {
                    foreach ($services as $service) {
                        echo "<article class=\"bgelt\">";
                        echo "<h3>" . htmlspecialchars($service["Nom"], ENT_QUOTES, 'UTF-8') . "</h3>";
                        echo "<p>" . htmlspecialchars($service["Description"], ENT_QUOTES, 'UTF-8') . "</p>";
                        echo "</article><hr>";
                    }
                } else {
                    echo '<p>Aucun service disponible.</p>';
                }
            } catch (PDOException $e) {
                echo '<p>Erreur: Dans la récupération des Services</p>';
                exit;
            }

        ?>

        <?php include('footer.html') ?>
    </body>
</html>
