<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM `nourriture` INNER Join animaux ON nourriture.ID_Animal = animaux.ID WHERE 1 LIMIT 50");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $CR_vet=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>