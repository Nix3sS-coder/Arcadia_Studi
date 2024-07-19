<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['pwd'], $postData['id'])){
        include("infosbase.php");

        $options = [
            'cost' => 12,
        ];
        
        $newPWD = password_hash($postData['pwd'], PASSWORD_BCRYPT, $options);
        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("UPDATE `utilisateur` SET `pwd`=? WHERE `ID`=?");

        
        $stmt->execute([ $newPWD, $postData['id']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'User mis à jour avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour mettre à jour l\'User');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de la mise à jour de l\'User : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>