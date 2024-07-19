<?php

// Définition de la fonction sendSMTPMail avant son utilisation
function sendSMTPMail($to, $cc, $bcc, $subject, $message, $headers) {
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 465;
    $smtpUser = 'nepasrepondredev@gmail.com';
    $smtpPass = 'iizt tblv zvfu oqcv';

    // Créer un contexte SSL
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);
    
    // Ouvrir une connexion au serveur SMTP
    $socket = stream_socket_client('ssl://'.$smtpHost.':'.$smtpPort, $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context);
    if (!$socket) {
        return "Erreur de connexion : $errno - $errstr\n";
    }

    // Fonction pour récupérer la réponse du serveur SMTP
    function getServerResponse($socket) {
        $response = '';
        while ($line = fgets($socket, 515)) {
            $response .= $line;
            if (substr($line, 3, 1) == ' ') {
                break;
            }
        }
        return $response;
    }

    // Enregistrer les réponses du serveur SMTP dans des variables
    $responses = [];
    $responses[] = getServerResponse($socket);

    fputs($socket, "EHLO " . gethostname() . "\r\n");
    $responses[] = getServerResponse($socket);

    fputs($socket, "AUTH LOGIN\r\n");
    $responses[] = getServerResponse($socket);

    fputs($socket, base64_encode($smtpUser) . "\r\n");
    $responses[] = getServerResponse($socket);

    fputs($socket, base64_encode($smtpPass) . "\r\n");
    $responses[] = getServerResponse($socket);

    fputs($socket, "MAIL FROM: <$smtpUser>\r\n");
    $responses[] = getServerResponse($socket);

    // Ajouter les adresses TO
    $toAddresses = explode(',', $to);
    foreach ($toAddresses as $toAddress) {
        fputs($socket, "RCPT TO: <$toAddress>\r\n");
        $responses[] = getServerResponse($socket);
    }

    // Ajouter les adresses CC
    if (!empty($cc)) {
        $ccAddresses = explode(',', $cc);
        foreach ($ccAddresses as $ccAddress) {
            fputs($socket, "RCPT TO: <$ccAddress>\r\n");
            $responses[] = getServerResponse($socket);
        }
    }

    // Ajouter les adresses BCC
    if (!empty($bcc)) {
        $bccAddresses = explode(',', $bcc);
        foreach ($bccAddresses as $bccAddress) {
            fputs($socket, "RCPT TO: <$bccAddress>\r\n");
            $responses[] = getServerResponse($socket);
        }
    }

    fputs($socket, "DATA\r\n");
    $responses[] = getServerResponse($socket);

    $emailMessage = "To: <$to>\r\n" .
                    "Subject: $subject\r\n" .
                    $headers .
                    "\r\n\r\n" .
                    $message . "\r\n.\r\n";

    fputs($socket, $emailMessage);
    $responses[] = getServerResponse($socket);

    fputs($socket, "QUIT\r\n");
    $responses[] = getServerResponse($socket);

    fclose($socket);
    return $responses;
}

?>