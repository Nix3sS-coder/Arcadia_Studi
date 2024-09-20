<?php

use PHPUnit\Framework\TestCase;

class HabitatIntegrationTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Configuration de la connexion à la base de données
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création des tables nécessaires
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `habitat` (
            `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `images_liste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `ID` int NOT NULL AUTO_INCREMENT,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `images` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `Fichier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
        
        // Vider les tables avant chaque test
        $this->pdo->exec("TRUNCATE TABLE `images`");
        $this->pdo->exec("TRUNCATE TABLE `habitat`");
    }

    protected function tearDown(): void
    {
        // Suppression des tables après le test

        // Fermeture de la connexion à la base de données
        $this->pdo = null;
    }

    public function testHabitatPageIntegration()
    {
        // Insérer des images pour le test
        $this->pdo->exec("INSERT INTO `images` (`Fichier`) VALUES ('image_test1.jpg'), ('image_test2.jpg')");

        // Vérifier que les images ont été insérées
        $stmt = $this->pdo->query("SELECT `ID` FROM `images`");
        $imageIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $this->assertCount(2, $imageIds, 'Deux images doivent être insérées.');

        // Insérer des habitats
        $this->pdo->exec("INSERT INTO `habitat` (`Nom`, `images_liste`, `description`) VALUES 
            ('Habitat Test 1', '{$imageIds[0]}', 'Description du Habitat Test 1'),
            ('Habitat Test 2', '{$imageIds[1]}', 'Description du Habitat Test 2')");

        // Vérifier l'affichage sur la page
        $url = "http://localhost:8080/Habitat.php"; // Assure-toi que cette URL est correcte
        $output = file_get_contents($url);
        
        // Vérifier les noms et descriptions
        $this->assertStringContainsString('Habitat Test 1', $output);
        $this->assertStringContainsString('Description du Habitat Test 1', $output);
        $this->assertStringContainsString('Habitat Test 2', $output);
        $this->assertStringContainsString('Description du Habitat Test 2', $output);
        
        // Vérifier les images
        $this->assertStringContainsString('src="Assets/Ajouts/image_test1.jpg"', $output);
        $this->assertStringContainsString('src="Assets/Ajouts/image_test2.jpg"', $output);

        // Tester l'absence d'habitats
        $this->pdo->exec("DELETE FROM `habitat`"); // Supprimer les habitats

        $output = file_get_contents($url);
        $this->assertStringContainsString('Aucun habitat trouvé', $output);
    }
}
