<?php

    include('PHP/Model/Avis_Recup.php');
    if(!empty($avis)){
        foreach($avis as $avi){
            echo "<div class=\"bgelt\">";
            echo "    <h3>".$avi['Pseudo']."</h3>";
            echo "    <p>".$avi['Avis']."</p>";
            echo "   <p>Valider ?</p>";
                if($avi['Valider']==1){
                echo "    <input type='checkbox' checked id='check".$avi['ID']."'></input>";
                }else{
                echo "    <input type='checkbox' id='check".$avi['ID']."'></input>";
                }
                
            echo "    <button onclick='changeValidate(".$avi['ID'].")'> Changer la validation </button>";
            echo "    <button onclick='SupprimerAvis(".$avi['ID'].")'> Supprimer l'Avis</button>";
            echo "</div>";
        }
    
    }else{
        echo "Aucun avis disponible";
    }

?>