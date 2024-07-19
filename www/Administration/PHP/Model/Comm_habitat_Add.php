<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['habitat'], $postData['avis'], $postData['etat'], $postData['amelioration'])){
        include("infosbase.php");

        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("INSERT INTO `comm_habitat`( `Avis`, `ETAT`, `Amelioration`, `ID_Habitat`) VALUES (?,?,?,?)");
        $stmt->execute([$postData['avis'], $postData['etat'], $postData['amelioration'],$postData['habitat']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'Commentaire d\'habitat ajouté avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour ajouter le commentaire sur l\'habitat');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de l\'ajout du commentaire sur l\'habitat : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
