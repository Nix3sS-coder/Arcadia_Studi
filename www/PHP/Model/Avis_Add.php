<?php


try {
    include("infosbase.php");
    // Requête SQL
    global $avis;
    global $pseudo;
    $stmt = $conn->prepare("INSERT INTO `avis`(`Pseudo`, `Avis`, `Valider`) VALUES (:Pseudo,:Avis,'0')");
    $stmt->execute(['Avis' => $avis,'Pseudo' => $pseudo]);


    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat=$stmt->fetchAll();
    $message="OK";
    //echo $message;
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>