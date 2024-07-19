<?php

include("PHP/Model/Comm_habitat_recup.php");
foreach($comm_habitat as $comm){
    echo "<div>";
    echo "<h3>".$comm['Nom']." </h3>";
    echo "<p>Avis : ".$comm['Avis']."</p>";  
    echo "<p>Etat : ".$comm['ETAT']."</p>";  
    if($comm["Amelioration"]==0){
        echo "<p>Ameliorable : Non</p>";  
    }else{
        echo "<p>Ameliorable : Oui</p>";  
    }
    echo "</div>";
}
?>