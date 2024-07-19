<?php


try {
    include("infosbase.php");
    // Requête SQL
    if($postData['amelioration']==false){
        $stmt = $conn->prepare("SELECT * FROM comm_habitat INNER JOIN habitat On comm_habitat.ID_Habitat=habitat.ID WHERE comm_habitat.ID_Habitat=? Limit 50");
        $stmt->execute([ $postData['habitat']]);
    }else{  
        $stmt = $conn->prepare("SELECT * FROM comm_habitat INNER JOIN habitat On comm_habitat.ID_Habitat=habitat.ID WHERE comm_habitat.ID_Habitat=? AND comm_habitat.Amelioration = 1 Limit 50");
        $stmt->execute([ $postData['habitat']]);
    }
    

    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $comm_hab=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>