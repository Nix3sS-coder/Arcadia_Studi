<?php
header('Content-Type: application/json');


try {
    // Vérifier si tous les paramètres nécessaires sont présents dans le payload JSON
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['habitat'], $postData['amelioration'])){
        include("../../PHP/Model/comm_recup_infos_filter.php");

        $html="";
        foreach($comm_hab as $comm){
            $html=$html."<div>";
            $html=$html."<h3>".$comm['Nom']." </h3>";
            $html=$html."<p>Avis : ".$comm['Avis']."</p>";  
            $html=$html."<p>Etat : ".$comm['ETAT']."</p>";  
            if($comm["Amelioration"]==0){
                $html=$html."<p>Ameliorable : Non</p>";  
            }else{
                $html=$html."<p>Ameliorable : Oui</p>";  
            }
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