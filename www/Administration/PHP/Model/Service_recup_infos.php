<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM services");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $services=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);
    // Debug : afficher les avis récupérés
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>