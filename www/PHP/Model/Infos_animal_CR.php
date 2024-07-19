
<?php

try {

    
        include("infosbase.php");
        global $Animal;
        // Requête SQL
        $stmt = $conn->prepare("SELECT * FROM `cr_veto` WHERE ID_Animal = :Animal ORDER BY date DESC LIMIT 1");
        $stmt->execute(['Animal' => $Animal]);
        
        // Définir le jeu de résultats sous forme de tableau associatif
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $CR=$stmt->fetchAll();



} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
