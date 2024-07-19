<article id="chooseimglst">
        <button id="existchooseimg" onclick="quittchooseimg()">EXIT</button>
        <input type="file" id="imageInput">
        <button onclick="uploadImage()">Upload</button>
        <p id="result"></p>
        <div id="lstimg">
            <?php
            try {
                // Dossier contenant les images
                $imageDir = '../Assets/Ajouts/';

                // Récupérer tous les fichiers jpg, jpeg, png du dossier
                $images = glob($imageDir . '*.{jpg,jpeg,png}', GLOB_BRACE);

                // Vérifier si des images ont été trouvées
                if ($images) {
                    include("../PHP/Model/infosbase.php");

                    // Préparer une requête pour vérifier les images dans la BDD
                    $stmt = $conn->prepare("SELECT ID, Fichier FROM images WHERE Fichier = :fichier");

                    foreach ($images as $image) {
                        $imagePath = htmlspecialchars($image);
                        $fileName = basename($imagePath); // Nom du fichier avec extension

                        // Exécuter la requête pour chaque image
                        $stmt->execute([':fichier' => $fileName]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Si l'image est trouvée dans la BDD, afficher l'ID correspondant
                        if ($result) {
                            echo '<img src="' . $imagePath . '" alt="Image" onclick="changeimg(\'' . $imagePath . '\',\'' . $result['ID'] . '\')">';
                        }
                    }

                } else {
                    echo 'Aucune image trouvée dans le dossier.';
                }

            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
            }

            // Fermer la connexion
            $conn = null;
            ?>
        </div>
    </article>
