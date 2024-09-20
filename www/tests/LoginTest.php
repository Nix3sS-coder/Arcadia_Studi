<?php
use PHPUnit\Framework\TestCase;
require_once 'config.php';

class LoginTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec('DROP TABLE IF EXISTS utilisateur');
        $this->pdo->exec('
            CREATE TABLE utilisateur (
                ID INTEGER PRIMARY KEY AUTO_INCREMENT,
                mail VARCHAR(50) NOT NULL,
                pwd VARCHAR(70) NOT NULL,
                role VARCHAR(50) NOT NULL
            )
        ');

        $this->pdo->exec('
            INSERT INTO utilisateur (mail, pwd, role)
            VALUES ("admin@gmail.com", "$2y$12$6/8J3DFQ9EUcWX1zgVqSneRZgM22fcNho5GsgWp7wEvfbvFTvN/zO", "1")
        ');

        $GLOBALS['pdo'] = $this->pdo;
    }

    public function testLoginWithCorrectCredentials()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'admin@gmail.com';
        $_GET['pwd'] = 'ARCADIAZOO!';

        ob_start();
        include(__DIR__ . '/../Login_check.php');
        ob_end_clean();

        #echo '<pre>';
         #print_r($GLOBALS['test_headers']);
         #echo '</pre>';

        $this->assertTrue($this->headerContains($GLOBALS['test_headers'], 'Location: /Administration/Menu.php'));
    }

    public function testLoginWithIncorrectPassword()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'admin@gmail.com';
        $_GET['pwd'] = 'wrongpassword';

        ob_start();
        include(__DIR__ . '/../Login_check.php');
        ob_end_clean();

         #echo '<pre>';
         #print_r($GLOBALS['test_headers']);
         #echo '</pre>';

        $this->assertTrue($this->headerContains($GLOBALS['test_headers'], 'Location: /Login.php?status=error'));
    }

    public function testLoginWithNonExistentEmail()
    {
        $GLOBALS['test_headers'] = [];

        $_GET['mail'] = 'nonexistent@gmail.com';
        $_GET['pwd'] = 'password123';

        ob_start();
        include(__DIR__ . '/../Login_check.php');
        ob_end_clean();

         #echo '<pre>';
         #print_r($GLOBALS['test_headers']);
         #echo '</pre>';

        $this->assertTrue($this->headerContains($GLOBALS['test_headers'], 'Location: /Login.php?status=error'));
    }

    protected function headerContains(array $headers, string $headerValue): bool
    {
        foreach ($headers as $header) {
            if (strpos($header, $headerValue) !== false) {
                return true;
            }
        }
        return false;
    }
}
?>
