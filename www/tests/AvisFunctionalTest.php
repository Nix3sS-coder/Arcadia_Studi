<?php

use PHPUnit\Framework\TestCase;

define('TEST', true);
require_once 'config.php';

class AvisFunctionalTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Initialiser la connexion PDO
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Créer la table `avis` si elle n'existe pas
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `avis` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `Pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Avis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Valider` tinyint(1) NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Vider la table `avis`
        $this->pdo->exec("TRUNCATE TABLE `avis`");

        // Simuler la connexion pour obtenir le cookie
        $GLOBALS['pdo'] = $this->pdo; // Assurez-vous que PDO est accessible globalement
        $this->simulateLogin('admin@gmail.com', 'ARCADIAZOO!');
    }

    protected function tearDown(): void
    {
        // Supprimer la table `avis`
        $this->pdo->exec("DROP TABLE IF EXISTS `avis`");
        $this->pdo = null;
    }

    public function testAvisManagementIntegration()
    {
        // Simuler un cookie de session
        $this->simulateCookie('user_data', ['mail' => 'admin@example.com', 'role' => 1]);

        // Insérer des avis de test
        $this->pdo->exec("INSERT INTO `avis` (`Pseudo`, `Avis`, `Valider`) VALUES 
            ('Utilisateur Test 1', 'Avis du Utilisateur Test 1', 0),
            ('Utilisateur Test 2', 'Avis du Utilisateur Test 2', 0)");

        // Récupérer les avis de la base de données pour vérification
        $stmt = $this->pdo->query("SELECT `ID` FROM `avis`");
        $avisIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        $this->assertCount(2, $avisIds, 'Deux avis doivent être insérés.');

        // URL de la page à tester
        $url = "http://127.0.0.1:8080/Administration/gestion_avis.php";

        // Récupérer le contenu de la page avec le cookie simulé
        $output = $this->getPageContentWithCookie($url);
        if ($output === false) {
            $this->fail("Erreur lors de la récupération de la page : $url");
        }

        // Vérifier la présence des avis sur la page
        $this->assertStringContainsString('Utilisateur Test 1', $output);
        $this->assertStringContainsString('Avis du Utilisateur Test 1', $output);
        $this->assertStringContainsString('Utilisateur Test 2', $output);
        $this->assertStringContainsString('Avis du Utilisateur Test 2', $output);

        // Supprimer les avis de test
        $this->pdo->exec("DELETE FROM `avis`");

        // Vérifier l'absence d'avis sur la page
        $output = $this->getPageContentWithCookie($url);
        if ($output === false) {
            $this->fail("Erreur lors de la récupération de la page : $url");
        }
        $this->assertStringContainsString('Aucun avis disponible', $output);
    }

    private function simulateCookie($name, $data)
    {
        $data_json = json_encode($data);
        $hmac = hash_hmac('sha256', $data_json, 'LeZOOArcadia!');
        $cookie_value = base64_encode($data_json . '|' . $hmac);
        $_COOKIE[$name] = $cookie_value;
    }

    private function simulateLogin($email, $password)
    {
        // Simuler une requête de connexion pour obtenir le cookie
        $_GET['mail'] = $email;
        $_GET['pwd'] = $password;

        ob_start();
        include(__DIR__ . '/../Login_check.php');
        ob_end_clean();
    }

    private function getPageContentWithCookie($url)
    {
        // Créer un contexte de flux avec le cookie simulé
        $options = [
            "http" => [
                "header" => "Cookie: " . http_build_query($_COOKIE, '', '; ') . "\r\n",
                "method" => "GET",
            ],
        ];
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }
}
