<?php
try {
    include("PHP/Model/habitat_infos.php");
    
    for($i = 0; $i < count($habitat); $i++) { 
        echo '<article class="bgelt" onclick="document.location.href=\'Detail_Habitat?habitat=' . htmlspecialchars($habitat[$i]['ID']) . '\'">';
        echo '<h3>' . htmlspecialchars($habitat[$i]['Nom']) . '</h3>';
        echo '<p>' . htmlspecialchars($habitat[$i]['description']) . '</p>';
        echo '<div>';

        foreach($photosliste[$i] as $photo){
            echo '<img src="Assets/Ajouts/' .$listphoto[$photo]['Fichier'] . '">';
        }
        
        echo '</div>';

        echo '</article>';
    }
    
} catch (PDOException $e) {
    echo "Erreur: " . htmlspecialchars($e->getMessage());
}
?>
