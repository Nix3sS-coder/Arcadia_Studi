<?php

use PHPUnit\Framework\TestCase;

require_once 'config.php';

class LoginFunctionalTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Créer le mock PDO
        $this->pdo = $this->createMock(PDO::class);

        // Créer le mock PDOStatement
        $this->stmt = $this->createMock(PDOStatement::class);

        // Initialiser les variables globales
        $GLOBALS['pdo'] = $this->pdo;
    }

    protected function tearDown(): void
    {
        // Nettoyer les variables globales
        unset($GLOBALS['pdo']);
        unset($GLOBALS['test_headers']);

        parent::tearDown();
    }

    public function testSuccessfulLogin()
    {
        // Configurer le mock pour retourner un utilisateur valide
        $this->stmt->method('fetch')->willReturn([
            'mail' => 'test@example.com',
            'pwd' => password_hash('Password123', PASSWORD_BCRYPT),
            'role' => 'admin'
        ]);
        $this->pdo->method('prepare')->willReturn($this->stmt);

        $GLOBALS['test_headers'] = [];
        $_GET['mail'] = 'test@example.com';
        $_GET['pwd'] = 'Password123';

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        // Débogage : Afficher les en-têtes pour vérifier le résultat
        #print_r($GLOBALS['test_headers']);
        $this->assertContains('Location: /Administration/Menu.php', $GLOBALS['test_headers']);
    }

    public function testLoginWithIncorrectPassword()
    {
        // Configurer le mock pour retourner un utilisateur valide
        $this->stmt->method('fetch')->willReturn([
            'mail' => 'test@example.com',
            'pwd' => password_hash('Password123', PASSWORD_BCRYPT),
            'role' => 'admin'
        ]);
        $this->pdo->method('prepare')->willReturn($this->stmt);

        $GLOBALS['test_headers'] = [];
        $_GET['mail'] = 'test@example.com';
        $_GET['pwd'] = 'WrongPassword';

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        // Débogage : Afficher les en-têtes pour vérifier le résultat
        #print_r($GLOBALS['test_headers']);
        $this->assertContains('Location: /Login.php?status=error', $GLOBALS['test_headers']);
    }

    public function testLoginWithNonExistentEmail()
    {
        // Configurer le mock pour simuler un utilisateur non trouvé
        $this->stmt->method('fetch')->willReturn(false);
        $this->pdo->method('prepare')->willReturn($this->stmt);

        $GLOBALS['test_headers'] = [];
        $_GET['mail'] = 'nonexistent@example.com';
        $_GET['pwd'] = 'Password123';

        ob_start();
        include(__DIR__ . '/../login_check.php');
        ob_end_clean();

        // Débogage : Afficher les en-têtes pour vérifier le résultat
        #print_r($GLOBALS['test_headers']);
        $this->assertArrayHasKey(0, $GLOBALS['test_headers']);
        $this->assertStringContainsString('Location: /Login.php?status=error', $GLOBALS['test_headers'][0]);
    }
}
