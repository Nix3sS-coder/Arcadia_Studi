
<?php

try {
    include("PHP/Model/avis_infos.php");
    //echo " resultats";
    //print_r($resultat);
    foreach($resultat as $infos){
            echo"<div>";
            echo"    <h3>".$infos['Pseudo']."</h3>";
            echo'    <p class="avis">'.$infos['Avis'].'</p>';
            echo"</div>";
    }

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

?>