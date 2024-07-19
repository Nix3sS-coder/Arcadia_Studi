<?php


try {
    include("infosbase.php");
    // Requête SQL
    $stmt = $conn->prepare("SELECT ID_Animal,Prenom,Race,Vues,habitat_ID FROM `stats` INNER JOIN animaux WHERE animaux.ID=stats.ID_Animal");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultat=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);

    $data=[];

    foreach($resultat as $result){
        $valuetoinsert=[];
        $valuetoinsert['label']=($result['Prenom'].", ".$result['Race']);
        $valuetoinsert['value']=$result['Vues'];
        array_push($data,$valuetoinsert);
    }

    $data = json_encode($data);



} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>