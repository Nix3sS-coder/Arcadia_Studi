<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['nom'], $postData['race'],$postData['hab'], $postData['imglst'])){
        include("infosbase.php");

        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("INSERT INTO `animaux`(`Prenom`, `race`, `images_liste`, `habitat_ID`) VALUES (?,?,?,?)");



        $stmt->execute([$postData['nom'], $postData['race'], $postData['imglst'],$postData['hab']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'Habitat ajouté avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour ajouté l\'habitat');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de l\'ajout de l\'habitat : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
