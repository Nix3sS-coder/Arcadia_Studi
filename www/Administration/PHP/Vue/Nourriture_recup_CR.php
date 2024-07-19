<?php
header('Content-Type: application/json');


try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['animal'])){
        include("../../PHP/Model/Nourriture_recup_CR.php");

        $html="";
        foreach($CR_vet as $cr){
            $html=$html."<div class=\"bgelt\">";
            $html=$html."<h3> Conseil Veterinaire pour ".$cr['Prenom'].", ".$cr['race']."</h3>";
            $html=$html."<p>Etat : ".$cr['etat']."</p>";
            $html=$html."<p>nourriture : ".$cr['nourriture']."</p>";
            $html=$html."<p>grammage : ".$cr['grammage']."</p>";
            $html=$html."<p>date : ".$cr['date']."</p>";
            $html=$html."<p>details : ".$cr['details']."</p>";
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