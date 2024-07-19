<?php

try {

    
        include("infosbase.php");
        global $habitat;
        // Requête SQL
        $stmt = $conn->prepare("SELECT * FROM animaux WHERE habitat_ID = :habitat_id");
        $stmt->execute(['habitat_id' => $habitat]);
        
        // Définir le jeu de résultats sous forme de tableau associatif
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $animaux=$stmt->fetchAll();


        //Listphoto and 
        include('Take_img.php');
        $takeID= takeimgIDfrominf($animaux); ;
        $listoffirstid=$takeID['listoffirstid'];
        $photos = $takeID['photos'];
        $photosliste=$takeID['photosliste'];
    
        $takeImg=takeimgfrominf($photos,$listoffirstid);
        $listphoto=$takeImg['listphoto'];
        $listfirstphoto=$takeImg['listfirstphoto'];
    


} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
