<?php

include("PHP/Model/recup_liste_habitat.php");
    echo"<div >";
    echo"<p>Choix habitat</p>";
    // Générer le sélecteur d'habitats
    echo '<select name="habitat" id="habitat-select">';
    echo '<option value="0">Tous</option>';

    foreach ($habitat as $hab) {
        echo '<option value="' . $hab['ID'] . '">' . $hab['Nom'] . '</option>';
    }
    echo '</select>';
    echo "</div>";
?>