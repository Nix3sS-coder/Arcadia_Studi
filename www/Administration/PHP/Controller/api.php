<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fonction pour générer une chaîne aléatoire de 15 caractères
    function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Vérifier si le fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Vérifier la taille du fichier (par exemple, max 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($_FILES['image']['size'] > $maxFileSize) {
            echo json_encode(['error' => 'Le fichier est trop grand. Taille maximale: 5MB.']);
            exit;
        }

        // Vérifier l'extension du fichier
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['error' => 'Extension de fichier non valide. Seules les extensions jpg, jpeg, png sont autorisées.']);
            exit;
        }

        // Générer un nom de fichier aléatoire pour l'image téléchargée
        $randomFileName = generateRandomString() . '.' . $fileExtension;

        // Dossier où les images seront sauvegardées
        $uploadDir = '../../../Assets/Ajouts/';

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Chemin complet pour sauvegarder le fichier avec le nom aléatoire
        $uploadFile = $uploadDir . $randomFileName;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Connexion à la base de données
            try {
                include("../Model/infosbase.php");

                // Préparer la requête SQL pour insérer le fichier dans la base de données
                $stmt = $conn->prepare("INSERT INTO `images`(`Fichier`) VALUES (:name)");

                // Exécuter la requête en passant le nom du fichier comme paramètre
                $stmt->execute([':name' => $randomFileName]);

                // Récupérer l'ID de la dernière insertion
                $lastInsertId = $conn->lastInsertId();

                // Afficher les détails de l'image téléchargée en JSON
                echo json_encode(['randomFileName' => $randomFileName, 'filePath' => $uploadFile, 'ID' => $lastInsertId]);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Erreur lors de la connexion à la base de données.']);
            }

            // Fermer la connexion à la base de données
            $conn = null;
        } else {
            // Erreur lors du déplacement du fichier
            echo json_encode(['error' => 'Erreur lors de la sauvegarde de l\'image.']);
        }
    } else {
        // Erreur lors du téléchargement de l'image
        echo json_encode(['error' => 'Erreur lors du téléchargement de l\'image.']);
    }
} else {
    echo json_encode(['error' => 'Méthode de requête non valide.']);
}
?>
