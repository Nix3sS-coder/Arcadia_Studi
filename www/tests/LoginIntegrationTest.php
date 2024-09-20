<?php

use PHPUnit\Framework\TestCase;

require_once 'config.php';

class LoginIntegrationTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Créer et peupler la table utilisateur pour les tests
        $this->pdo->exec('DROP TABLE IF EXISTS utilisateur');
        $this->pdo->exec('
            CREATE TABLE utilisateur (
                ID INTEGER PRIMARY KEY AUTO_INCREMENT,
                mail VARCHAR(50) NOT NULL,
                pwd VARCHAR(70) NOT NULL,
                role VARCHAR(50) NOT NULL
            )
        ');

        // Ajouter un utilisateur avec un mot de passe haché
        $this->pdo->exec('
            INSERT INTO utilisateur (mail, pwd, role)
            VALUES ("admin@gmail.com", "$2y$12$6/8J3DFQ9EUcWX1zgVqSneRZgM22fcNho5GsgWp7wEvfbvFTvN/zO", "admin")
        ');

        $GLOBALS['pdo'] = $this->pdo;
    }

    protected function tearDown(): void
    {
        // Nettoyer les données après chaque test
        $this->pdo->exec('DROP TABLE IF EXISTS utilisateur');
        parent::tearDown();
    }

    public function testLoginRedirectsToAdminMenu()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'admin@gmail.com';
        $_GET['pwd'] = 'ARCADIAZOO!'; // Assurez-vous que ce mot de passe est correct pour l'utilisateur

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        $this->assertContains('Location: /Administration/Menu.php', $GLOBALS['test_headers'], "L'en-tête de redirection ne contient pas '/Administration/Menu.php'.");
    }

    public function testLoginRedirectsToErrorPageOnInvalidCredentials()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'admin@gmail.com';
        $_GET['pwd'] = 'wrongpassword'; // Mot de passe incorrect

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        $this->assertContains('Location: /Login.php?status=error', $GLOBALS['test_headers'], "L'en-tête de redirection ne contient pas '/Login.php?status=error'.");
    }

    public function testLoginRedirectsToErrorPageOnNonExistentEmail()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'nonexistent@gmail.com';
        $_GET['pwd'] = 'password1'; // Mot de passe pour un email inexistant

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        $this->assertContains('Location: /Login.php?status=error', $GLOBALS['test_headers'], "L'en-tête de redirection ne contient pas '/Login.php?status=error'.");
    }
}
?>
