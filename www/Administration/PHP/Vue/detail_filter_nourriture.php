<?php
header('Content-Type: application/json');


try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['ID'], $postData['D1'], $postData['D2'])){
        include("../../PHP/Model/nourriture_recup_infos_filter.php");

        $html="";
        foreach($CR_vet as $cr){
            $html=$html."<div class=\"bgelt\">";
            $html=$html."<h3> ".$cr['Prenom'].", ".$cr['race']."</h3>";
            $html=$html."<p>Date et Heure: ".$cr['Date'].", ".$cr['heure']."</p>";
            $html=$html."<p>nourriture : ".$cr['Quantité'].", ".$cr['nourriture']."</p>";
            $html=$html."</div>";
        }

        // Réponse JSON à envoyer en retour en cas de succès
        $response = array(
            'status' => 'success',
            'message' => 'Filtre appliqué OK',
            'html' => $html
        );

        echo json_encode($response);
    } else {
        // Si des paramètres sont manquants, renvoyer un message d'erreur
        throw new Exception('Paramètres manquants pour utiliser le Filtre');
    }
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo json_encode(array('status' => 'error', 'message' => 'Erreur du filtrage : ' . $e->getMessage()));
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

// Fermer la connexion à la base de données
$conn = null;
?>