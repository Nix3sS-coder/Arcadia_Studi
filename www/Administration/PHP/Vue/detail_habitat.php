<?php


try {
    include("../PHP/Model/habitat_infos.php");
    $compteur=0;
    foreach($habitat as $hab){

        echo '<article id="habitat'.$hab['ID'].'">';
        echo '<button onclick="modif(\''.$hab['ID'].'\')"> Modifier </button>';
        echo '<button onclick="supp(\''.$hab['ID'].'\')"> Supprimer </button>';
        echo '<input type="text" value="'.$hab['Nom'].'" id="nom'.$hab['ID'].'">';

        echo ' <textarea id="desc'.$hab['ID'].'"> '.$hab['description'].'</textarea>';

        echo ' <div id="lstimg'.$hab['ID'].'">';
        echo '<button id="addimg" onclick="addimg(\''.$hab['ID'].'\')"> Add IMG </button>';
                //detail des images en resumé + elements
                $nbphoto=0;
                foreach($photosliste[$compteur] as $photo){
                    //print_r($listphoto);
                    echo "<div class='imgrmv' id='img".$compteur.$nbphoto."'>";
                    echo '<img id="'.$listphoto[$photo]['ID'].'img'.$hab['ID'].$compteur.$nbphoto.'" src="../Assets/Ajouts/' . $listphoto[$photo]['Fichier'] . '" onclick="checkforchange(\''.$listphoto[$photo]['ID'].'img'.$hab['ID'].$compteur.$nbphoto.'\',1)">';
                    
                    echo "<button onclick='removeimg(\"img".$compteur.$nbphoto."\")'>-</button>";
                    echo "</div>";
                    $nbphoto++;
                }

        echo '</div>';
        

        echo '</article>';
        $compteur++;
    }

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>