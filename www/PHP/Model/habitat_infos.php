<?php

try {
    include("infosbase.php");
    
    // Création de la connexion
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM habitat");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $habitat=$stmt->fetchAll();
    //echo " resultats";
    //print_r($resultat);



    include('Take_img.php');
    $takeID= takeimgIDfrominf($habitat); ;
    $listoffirstid=$takeID['listoffirstid'];
    $photos = $takeID['photos'];
    $photosliste=$takeID['photosliste'];

    $takeImg=takeimgfrominf($photos,$listoffirstid);
    $listphoto=$takeImg['listphoto'];
    $listfirstphoto=$takeImg['listfirstphoto'];


    //Listphoto and 
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>