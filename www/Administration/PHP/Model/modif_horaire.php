<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['lun'], $postData['mar'], $postData['merc'], $postData['jeu'], $postData['ven'], $postData['sam'], $postData['dim'])){
        include("infosbase.php");

        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("UPDATE `horaire` SET `lundi`=?,`mardi`=?,`mercredi`=?,`jeudi`=?,`vendredi`=?,`samedi`=?,`dimanche`=? WHERE 1");
        $stmt->execute([$postData['lun'], $postData['mar'], $postData['merc'], $postData['jeu'], $postData['ven'], $postData['sam'], $postData['dim']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'horaire mis à jour avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour mettre à jour l\'horaire');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de la mise à jour de l\'horaire : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
