<?php

use PHPUnit\Framework\TestCase;

class ServicesIntegrationTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Initialiser la connexion PDO
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Créer la table `services` si elle n'existe pas
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `services` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    }

    public function testServicesDisplaysCorrectly()
    {
        // Préparer la requête pour insérer des données de test
        $this->pdo->exec("INSERT INTO services (Nom, Description) VALUES ('Service Test', 'Description Test')");

        // URL de la page à tester
        $url = 'http://127.0.0.1:8080/Services.php';

        // Récupérer le contenu de la page
        $output = file_get_contents($url);

        // Vérifier que le contenu de la page contient les balises HTML attendues
        $this->assertStringContainsString('<h2 class="bgelt">Services</h2>', $output);
        $this->assertStringContainsString('<article class="bgelt">', $output);
        $this->assertStringContainsString('Service Test', $output);
        $this->assertStringContainsString('Description Test', $output);

        // Nettoyer les données de test
        $this->pdo->exec("DELETE FROM services WHERE Nom = 'Service Test'");
    }

    public function testServicesHandlesDatabaseErrors()
    {
        // Créer un mock de PDO
        $pdoMock = $this->createMock(PDO::class);
        
        // Configurer le mock pour lancer une exception lors de la connexion
        $pdoMock->method('query')->will($this->throwException(new PDOException('Erreur de connexion')));
    
        // Remplacer PDO par le mock
        $GLOBALS['pdo'] = $pdoMock;
    
        // URL de la page à tester
        $url = 'http://127.0.0.1:8080/Services.php';
    
        // Récupérer le contenu de la page
        $output = file_get_contents($url);
    
        // Débogage : vérifier le contenu complet
        file_put_contents('output.html', $output);
    
        // Vérifier que le message d'erreur est affiché
        $this->assertStringContainsString('Aucun service disponible.', $output);
    }
}
