<?php

// Vérifier les paramètres GET avant d'appeler la fonction
if(isset($_GET["title"]) && isset($_GET["desc"]) && isset($_GET["mail"])) {
    include('../Model/mail.php');
    $title = $_GET["title"];
    $desc = $_GET["desc"];
    $mail = $_GET["mail"];
    
    $to = $mail;
    $cc = ''; // Ajouter les adresses CC si nécessaire
    $bcc = 'studiarcadia@gmail.com'; // Ajouter les adresses BCC si nécessaire
    $subject = $title;
    $message = '<html>
                    <body>
                        <h1>Message de l\'interface d\'ARCADIA</h1>
                        <p>'.$desc.'</p>
                        <p>Une réponse vous sera apportée dans les meilleurs délais. Merci de votre message.</p>
                    </body>
                </html>';

    $headers = 'From: studiarcadia@gmail.com' . "\r\n" .
               'Reply-To: studiarcadia@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion() . "\r\n" .
               'MIME-Version: 1.0' . "\r\n" .
               'Content-Type: text/html; charset=UTF-8';

    $responses = sendSMTPMail($to, $cc, $bcc, $subject, $message, $headers);

    if (is_array($responses) && !empty($responses)) {
        echo 'Email envoyé avec succès.';
    } else {
        echo 'L\'envoi de l\'email a échoué.';
    }
}

?>
<Button onclick="history.back()"> Retour à l'Accueil</button>
