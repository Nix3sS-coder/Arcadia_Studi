<?php

include("PHP/Model/CR_recup_infos_all.php");

foreach($CR_vet as $cr){
    echo "<div class=\"bgelt\">";
    echo "<h3> ".$cr['Prenom'].", ".$cr['race']."</h3>";
    echo "<p>Etat : ".$cr['etat']."</p>";
    echo "<p>nourriture : ".$cr['nourriture']."</p>";
    echo "<p>grammage : ".$cr['grammage']."</p>";
    echo "<p>date : ".$cr['date']."</p>";
    echo "<p>details : ".$cr['details']."</p>";
    echo "</div>";
}
?>