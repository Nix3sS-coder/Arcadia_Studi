
<?php
header('Content-Type: application/json');

try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['mail'], $postData['role'],$postData['pwd'])){
        include("infosbase.php");
        $options = [
            'cost' => 12,
        ];
        
        $newPWD = password_hash($postData['pwd'], PASSWORD_BCRYPT, $options);

        // Préparer et exécuter la requête SQL pour mettre à jour l'habitat
        $stmt = $conn->prepare("INSERT INTO `utilisateur`(`mail`, `pwd`, `role`) VALUES (?,?,?)");



        $stmt->execute([$postData['mail'],  $newPWD, $postData['role']]);

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'Utilisateur ajouté avec succès'
        );
        include('../../../PHP/Model/mail.php');
        include('mail_confirm.php');
        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour ajouté l\'Utilisateur');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur lors de l\'ajout de l\'Utilisateur : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>
