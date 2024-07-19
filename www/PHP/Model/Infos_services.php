<?php

try {

    
        include("infosbase.php");
        global $Animal;
        // Requête SQL
        $stmt = $conn->prepare("SELECT * FROM `services`");
        $stmt->execute();
        
        // Définir le jeu de résultats sous forme de tableau associatif
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $services=$stmt->fetchAll();



} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
