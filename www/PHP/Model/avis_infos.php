
<?php

try {
    
    include("PHP/Model/infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM `avis` WHERE `Valider`=1 ORDER BY `ID` DESC LIMIT 10;");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat=$stmt->fetchAll();
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