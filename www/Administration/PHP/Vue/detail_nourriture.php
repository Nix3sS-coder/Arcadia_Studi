<?php

include("PHP/Model/nourriture_recup_infos_all.php");

foreach($CR_vet as $cr){
    echo "<div class=\"bgelt\">";
    echo "<h3> ".$cr['Prenom'].", ".$cr['race']."</h3>";
    echo "<p>Date et Heure: ".$cr['Date'].", ".$cr['heure']."</p>";
    echo "<p>nourriture : ".$cr['Quantité'].", ".$cr['nourriture']."</p>";
    echo "</div>";
}
?>