<?php
    include("infosbase.php");
    function takeimgfrominf($photos,$listoffirstid){ 
            // Création de la connexion
        global $conn;
        //echo " resultats";
        //print_r($resultat);
        $listphoto=[];
        $listfirstphoto=[];
        foreach($photos as $photo){ 
            $stmt2 = $conn->prepare("SELECT Fichier,ID FROM images WHERE ID = :photo_id");
            $stmt2->execute(['photo_id' => $photo]);
            $resultat2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $listphoto[$photo]=$resultat2;
            if(in_array($photo, $listoffirstid)){
                array_push($listfirstphoto,$resultat2['Fichier']);
                }
        }
        return ['listphoto' => $listphoto,'listfirstphoto' => $listfirstphoto];
    }

    function takeimgIDfrominf($habitat){
        global $conn;
        $listoffirstid=[];
        $photos = [];
        $photosliste=[];
        for ($i = 0; $i < count($habitat); $i++) {
            $encours = "";
            $images_liste = $habitat[$i]['images_liste'];
            $first=1;
            $photostoadd=[];
            // Vérification si 'images_liste' est une chaîne non vide
            if (is_string($images_liste) && !empty($images_liste)) {
                for ($b = 0; $b < strlen($images_liste); $b++) {
                    if ($images_liste[$b] == "/") {
                        array_push($photos, $encours);
                        array_push($photostoadd,$encours);
                        if($first==1){
                            array_push($listoffirstid,$encours);
                            $first+=1;
                        }
                        $encours = ""; // Réinitialiser $encours après l'ajout
                    } else {
                        $encours .= $images_liste[$b];
                    }
                }
                if($first==1){
                    array_push($listoffirstid,$encours);
                    $first+=1;
                }
                array_push($photostoadd,$encours);
                array_push($photos, $encours); // Ajouter le dernier élément
            }
            array_push($photosliste,$photostoadd);
        }

        return ['listoffirstid' => $listoffirstid, 'photos' => $photos, 'photosliste' => $photosliste];
    }
    
?>