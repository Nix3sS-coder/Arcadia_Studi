<?php


try {
    


    //include("../PHP/Model/animaux_par_habitat_ID_infos.php");
    //$IdHabitat=;
    //include("../PHP/Model/animaux_par_ID_Animal.php");
    //$idAnimal=;
    include("PHP/Model/animaux_infos.php");

    include("PHP/Model/recup_liste_habitat.php");
    $compteur=0;
    foreach($animaux as $anim){

        echo '<article id="habitat'.$anim['ID'].'">';
        echo '<button onclick="modif(\''.$anim['ID'].'\')"> Modifier </button>';
        echo '<button onclick="supp(\''.$anim['ID'].'\')"> Supprimer </button>';
        echo '<input type="text" value="'.$anim['Prenom'].'" id="nom'.$anim['ID'].'">';
        echo '<input type="text" value="'.$anim['race'].'" id="race'.$anim['ID'].'">';

        echo '<select name="habitat" id="selecthabitat'.$anim['ID'].'" value="'.$anim['habitat_ID'].'">';

        foreach($habitat as $hab){
            if($hab['ID']==$anim['habitat_ID']){
                
                echo '<option value="'.$hab['ID'].'" selected="selected">'.$hab['Nom'].'</option>';
            }else{
                echo '<option value="'.$hab['ID'].'">'.$hab['Nom'].'</option>';
            }
           
        }

        echo '</select>';


        echo ' <div id="lstimg'.$anim['ID'].'">';
        echo '<button id="addimg" onclick="addimg(\''.$anim['ID'].'\')"> Add IMG </button>';
                //detail des images en resumé + elements
                $nbphoto=0;
                foreach($photosliste[$compteur] as $photo){
                    //print_r($listphoto);
                    echo "<div class='imgrmv' id='img".$compteur.$nbphoto."'>";
                    echo '<img id="'.$listphoto[$photo]['ID'].'img'.$anim['ID'].$compteur.$nbphoto.'" src="../Assets/Ajouts/' . $listphoto[$photo]['Fichier'] . '" onclick="checkforchange(\''.$listphoto[$photo]['ID'].'img'.$anim['ID'].$compteur.$nbphoto.'\',1)">';
                    
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