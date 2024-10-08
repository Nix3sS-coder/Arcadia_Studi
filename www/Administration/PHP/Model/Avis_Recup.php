<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM avis ORDER BY ID DESC");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $avis=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);
    // Debug : afficher les avis récupérés
    echo "<pre>";
    print_r($avis);
    echo "</pre>";
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>