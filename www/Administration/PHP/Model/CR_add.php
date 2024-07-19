<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['animal'], $postData['date'],$postData['Etat'], $postData['nourriture'], $postData['grammage'], $postData['Details'])){
        include("infosbase.php");

        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("INSERT INTO `cr_veto`(`etat`, `nourriture`, `grammage`, `date`, `details`, `ID_Animal`) VALUES (?,?,?,?,?,?)");

        $stmt->execute([$postData['Etat'], $postData['nourriture'], $postData['grammage'],$postData['date'], $postData['Details'], $postData['animal']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'CR ajouté avec succès'
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour ajouter le CR');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de l\'ajout du CR : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
