<?php
try {
    // Vérifier si les paramètres GET 'mail' et 'pwd' existent
    if(isset($_GET['mail']) && isset($_GET['pwd'])){ 
        include("PHP/Model/infosbase.php");
        
        // Récupérer les valeurs des paramètres GET
        $mail = $_GET['mail'];
        $pwd = $_GET['pwd'];
        
        // Préparer et exécuter la requête SQL pour récupérer l'utilisateur par son email
        $stmt = $conn->prepare("SELECT * FROM `utilisateur` WHERE mail=:mail");
        $stmt->execute(['mail' => $mail]);
        
        // Récupérer le résultat sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier si un utilisateur correspondant à l'email a été trouvé
        if ($result) {
            // Vérifier si le mot de passe correspond à celui stocké dans la base de données
            if (password_verify($pwd, $result['pwd'])) {
                // Mot de passe valide, créer le cookie sécurisé
                
                
// Clé secrète pour HMAC
define('SECRET_KEY', 'LeZOOArcadia!');

// Créer un cookie avec des données protégées par HMAC
function create_secure_cookie($name, $data) {
    $data_json = json_encode($data);
    $hmac = hash_hmac('sha256', $data_json, SECRET_KEY);
    $cookie_value = base64_encode($data_json . '|' . $hmac);
    setcookie($name, $cookie_value, [
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}


                create_secure_cookie('user_data', ['mail' => $mail, 'role' => $result['role']]);
                header('Location: /Administration/Menu.php');
                exit; // Assurez-vous de sortir du script après une redirection header
            } else {
                // Mot de passe invalide
                header('Location: /login.php?status=error');
                exit; // Sortie du script après la redirection
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            header('Location: /login.php?status=error');
            exit; // Sortie du script après la redirection
        }
    }
} catch (PDOException $e) {
    // Gestion des erreurs PDO
    echo "Erreur: " . $e->getMessage();
}

// Assurez-vous de fermer la connexion à la base de données
$conn = null;
?>
