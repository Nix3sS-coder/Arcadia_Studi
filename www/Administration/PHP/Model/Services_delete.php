<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['id'])){
        include("infosbase.php");

        $stmt = $conn->prepare("DELETE FROM `services` WHERE `ID`=?");

        
        $stmt->execute([$postData['id']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'service supprimé avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour supprimer le service');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de la suppression du service : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
