<?php
    $to = $postData['mail'];
    $cc = ''; // Ajouter les adresses CC si nécessaire
    $bcc = 'studiarcadia@gmail.com'; // Ajouter les adresses BCC si nécessaire
    $subject = "Creation de compte Arcadia";
    $message = '<html>
                    <body>
                        <h1>Message de l\'interface d\'ARCADIA</h1>
                        <p>Votre compte ARCADIA a bien été créer </p>
                        <p>Merci de vous rapprocher de l\'administrateur afin d\'obtenir votre mot de passe</p>
                    </body>
                </html>';

    $headers = 'From: studiarcadia@gmail.com' . "\r\n" .
               'Reply-To: studiarcadia@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion() . "\r\n" .
               'MIME-Version: 1.0' . "\r\n" .
               'Content-Type: text/html; charset=UTF-8';

    $responses = sendSMTPMail($to, $cc, $bcc, $subject, $message, $headers);

?>