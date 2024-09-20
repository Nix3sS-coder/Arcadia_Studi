<?php
try {
    include(__DIR__ . '/../Model/habitat_infos.php');
    global $habitat, $photosliste, $listphoto;
    // Vérifiez si la variable $habitat est vide
    var_dump($habitat, $photosliste, $listphoto);
    if (empty($habitat)) {
        echo '<p>Aucun habitat trouvé</p>';
    } else {
        // Si $habitat n'est pas vide, affichez les informations sur les habitats
        for ($i = 0; $i < count($habitat); $i++) { 
            echo '<article class="bgelt" onclick="document.location.href=\'Detail_Habitat.php?habitat=' . htmlspecialchars($habitat[$i]['ID']) . '\'">';
            echo '<h3>' . htmlspecialchars($habitat[$i]['Nom']) . '</h3>';
            echo '<p>' . htmlspecialchars($habitat[$i]['description']) . '</p>';
            echo '<div>';

            foreach ($photosliste[$i] as $photo) {
                echo '<img src="Assets/Ajouts/' . htmlspecialchars($listphoto[$photo]['Fichier']) . '">';
            }

            echo '</div>';
            echo '</article>';
        }
    }
    
} catch (PDOException $e) {
    echo "Erreur: " . htmlspecialchars($e->getMessage());
}
?>
