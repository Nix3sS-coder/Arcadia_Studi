<?php

try {
    include("infosbase.php");

    // Vérifier s'il y a un fichier téléchargé
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Obtenir le nom du fichier avec extension
        $fileName = $_FILES['file']['name'];

        // Préparer la requête SQL pour insérer le fichier dans la base de données
        $stmt = $conn->prepare("INSERT INTO `images`(`Fichier`) VALUES (:name)");
        
        // Exécuter la requête en passant le nom du fichier comme paramètre
        $stmt->execute([':name' => $fileName]);
        
        // Récupérer l'ID de la dernière insertion
        $lastInsertId = $conn->lastInsertId();
        
        // Afficher l'ID du fichier inséré (vous pouvez retourner cet ID si nécessaire)
        echo $lastInsertId;
    } else {
        echo "Aucun fichier téléchargé ou une erreur est survenue lors du téléchargement.";
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
