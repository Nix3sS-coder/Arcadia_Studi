<?php
try {
    include("infosbase.php");
    global $habitat;
    // Requête SQL
    $stmt = $conn->prepare("SELECT Nom FROM `habitat` WHERE ID=:habitat_id");
    $stmt->execute(['habitat_id' => $habitat]);
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $nomHabitat=$stmt->fetchAll();

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>