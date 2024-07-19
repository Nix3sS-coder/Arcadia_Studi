<?php
try {
        include("PHP/Model/habitat_infos.php");
        //print_r($photos) ;
        for($i=0;$i<count($habitat);$i++){ 
            
            echo "<div>";
            echo '<h3 class="nomhab">' . htmlspecialchars($habitat[$i]['Nom']) . '</h3>';
            echo '    <img src="Assets/Ajouts/' . $listfirstphoto[$i]. '">';
                
            echo '</div>';
        }
        

       
    
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

?>