<?php

try {
    include("PHP/Model/infosbase.php");

    // ID de l'animal
    $ID=$animaux[0]["ID"];

    // Requête pour récupérer les statistiques de l'animal avec ID_Animal = 1
    $stmt1 = $conn->prepare("SELECT ID_Animal, Vues FROM stats WHERE ID_Animal = :ID");
    $stmt1->execute(['ID' => $ID]);

    // Récupérer les résultats sous forme de tableau associatif
    $resultat1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'animal existe dans la table stats
    if(empty($resultat1)){
        // Si l'animal n'existe pas, l'insérer avec Vues = 1
        $stmt = $conn->prepare("INSERT INTO stats (ID_Animal, Vues) VALUES (:ID, 1)");
        $stmt->execute(['ID' => $ID]);
    } else {
        // Si l'animal existe, mettre à jour le nombre de vues
        $nouvelles_vues = $resultat1['Vues'] + 1;
        $stmt = $conn->prepare("UPDATE stats SET Vues = :Vues WHERE ID_Animal = :ID");
        $stmt->execute(['ID' => $ID, 'Vues' => $nouvelles_vues]);
    }

    // Affichage des résultats (pour le débogage)
    //print_r($resultat1);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
