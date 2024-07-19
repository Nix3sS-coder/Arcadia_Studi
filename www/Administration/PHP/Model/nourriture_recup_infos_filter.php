<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM `nourriture` INNER JOIN `animaux` ON `nourriture`.`ID_Animal` = `animaux`.`ID` WHERE `nourriture`.`ID_Animal` = ? AND `nourriture`.`date` BETWEEN ? AND ? LIMIT 50");
    $stmt->execute([ $postData['ID'], $postData['D1'],$postData['D2']]);
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $CR_vet=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>