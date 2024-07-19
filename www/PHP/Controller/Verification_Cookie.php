<?php
define('SECRET_KEY', 'LeZOOArcadia!');

// Lire et vérifier un cookie
function read_secure_cookie($name) {
    if (isset($_COOKIE[$name])) {
        $cookie_value = base64_decode($_COOKIE[$name]);
        list($data_json, $hmac) = explode('|', $cookie_value);
        if (hash_hmac('sha256', $data_json, SECRET_KEY) === $hmac) {
            return json_decode($data_json, true);
        }
    }
    return null;
}

// Lire le cookie sécurisé
//$user_data = read_secure_cookie('user_data');
//if ($user_data) {
//    echo 'Bienvenue, ' . htmlspecialchars($user_data['mail']) . '! Votre email est ' . htmlspecialchars($user_data['role']) . '.';
//} else {
//    echo 'Cookie invalide ou falsifié.';
//}

?>
