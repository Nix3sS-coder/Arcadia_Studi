<?php

try {

    
        include("infosbase.php");
        global $Animal;
        // Requête SQL
        $stmt = $conn->prepare("SELECT * FROM animaux WHERE ID = :Animal");
        $stmt->execute(['Animal' => $Animal]);
        
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
