<?php
// Paramètres de connexion
$servername = "mysql";  // Nom du service MySQL dans docker-compose
$username = "root";
$password = "PasswordForRoot@2023!";
$dbname = "arcadia";


    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Définir le mode d'erreur PDO à Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
