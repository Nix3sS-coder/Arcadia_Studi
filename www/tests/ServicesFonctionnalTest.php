<?php

use PHPUnit\Framework\TestCase;

require_once 'config.php';

class ServicesFonctionnalTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `services` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `Nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        $this->pdo->exec("TRUNCATE TABLE `services`");

        // Simuler la connexion pour obtenir le cookie
        $this->simulateCookie('user_data', ['mail' => 'admin@example.com', 'role' => 1]);
    }

    protected function tearDown(): void
    {
        $this->pdo->exec("DROP TABLE IF EXISTS `services`");
        $this->pdo = null;
    }

    public function testServicesManagementIntegration()
    {
        // Ajouter des services à la base de données
        $this->pdo->exec("INSERT INTO `services` (`Nom`, `Description`) VALUES 
            ('Service Test 1', 'Description du Service Test 1'),
            ('Service Test 2', 'Description du Service Test 2')");

        $url = "http://127.0.0.1:8080/Administration/Services_Gestion.php";

        $output = $this->getPageContentWithCookie($url);
        if ($output === false) {
            $this->fail("Erreur lors de la récupération de la page : $url");
        }

        // Vérifier la présence des services dans le contenu de la page
        $this->assertStringContainsString('Service Test 1', $output);
        $this->assertStringContainsString('Description du Service Test 1', $output);
        $this->assertStringContainsString('Service Test 2', $output);
        $this->assertStringContainsString('Description du Service Test 2', $output);

        // Supprimer les services
        $this->pdo->exec("DELETE FROM `services`");

        // Vérifier que la page affiche "Aucun service disponible"
        $output = $this->getPageContentWithCookie($url);
        if ($output === false) {
            $this->fail("Erreur lors de la récupération de la page : $url");
        }
        $this->assertStringContainsString('Aucun service disponible', $output);
    }

    private function simulateCookie($name, $data)
    {
        $data_json = json_encode($data);
        $hmac = hash_hmac('sha256', $data_json, 'LeZOOArcadia!');
        $cookie_value = base64_encode($data_json . '|' . $hmac);
        $_COOKIE[$name] = $cookie_value;
    }

    private function getPageContentWithCookie($url)
    {
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
