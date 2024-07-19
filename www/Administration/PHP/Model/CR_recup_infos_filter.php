<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM `cr_veto` INNER JOIN `animaux` ON `cr_veto`.`ID_Animal` = `animaux`.`ID` WHERE `cr_veto`.`ID_Animal` = ? AND `cr_veto`.`date` BETWEEN ? AND ? LIMIT 50;");
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