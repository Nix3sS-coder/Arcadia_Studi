<?php
// Paramètres de connexion
$servername = "eu-cluster-west-01.k8s.cleardb.net";
$username = "b0de82451659ae";
$password = "664958ce";
$dbname = "heroku_014671c5cd10699";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
