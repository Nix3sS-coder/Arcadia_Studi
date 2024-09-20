<?php
try {
    if (isset($_GET['mail']) && isset($_GET['pwd'])) {
        $test_mode = defined('TEST_MODE') && TEST_MODE;
        if ($test_mode) {
            global $pdo;
            $conn = $pdo;
        } else {
            include("PHP/Model/infosbase.php");
        }

        $mail = $_GET['mail'];
        $pwd = $_GET['pwd'];

        $stmt = $conn->prepare("SELECT * FROM `utilisateur` WHERE mail=:mail");
        $stmt->execute(['mail' => $mail]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (password_verify($pwd, $result['pwd'])) {
                if (!defined('SECRET_KEY')) {
                    define('SECRET_KEY', 'LeZOOArcadia!');
                }
                if (!function_exists('create_secure_cookie')) {
                    function create_secure_cookie($name, $data) {
                        // Convertir les données en JSON
                        $data_json = json_encode($data);
                        
                        // Calculer le HMAC pour garantir l'intégrité des données
                        $hmac = hash_hmac('sha256', $data_json, SECRET_KEY);
                        
                        // Créer la valeur du cookie en combinant les données JSON et le HMAC
                        $cookie_value = base64_encode($data_json . '|' . $hmac);
                        
                        // Définir le cookie avec des options de sécurité
                        setcookie($name, $cookie_value, [
                            'expires' => time() + 3600, // Expiration dans 1 heure
                            'path' => '/',
                            'secure' => isset($_SERVER['HTTPS']), // Assurer la sécurité si HTTPS est utilisé
                            'httponly' => true, // Empêcher l'accès au cookie par JavaScript
                            'samesite' => 'Lax' // Gestion des cookies pour les requêtes inter-domaines
                        ]);
                    }
                }
               

                if ($test_mode) {
                    $GLOBALS['test_headers'][] = 'Location: /Administration/Menu.php';
                } else {
                    create_secure_cookie('user_data', ['mail' => $mail, 'role' => $result['role']]);
                    header('Location: /Administration/Menu.php');
                    exit;
                }
            } else {
                if ($test_mode) {
                    $GLOBALS['test_headers'][] = 'Location: /Login.php?status=error';
                } else {
                    header('Location: /Login.php?status=error');
                    exit;
                }
            }
        } else {
            if ($test_mode) {
                $GLOBALS['test_headers'][] = 'Location: /Login.php?status=error';
            } else {
                header('Location: /Login.php?status=error');
                exit;
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>
