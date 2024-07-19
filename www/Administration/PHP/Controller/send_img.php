
    <article>
        <input type="file" id="imageInput">
        <button onclick="uploadImage()">Upload</button>
        <p id="result"></p>
        <div id="lstimg">
            <?php
            // Dossier contenant les images
            $imageDir = '../../../Assets/Ajouts/';

            // Récupérer tous les fichiers jpg, jpeg, png du dossier
            $images = glob($imageDir . '*.{jpg,jpeg,png}', GLOB_BRACE);

            // Vérifier si des images ont été trouvées
            if ($images) {
                foreach ($images as $image) {
                    $imagePath = htmlspecialchars($image);
                    echo '<img src="' . $imagePath . '" alt="Image" onclick="changeimg(\''.$imagePath.'\')">';
                }
            } else {
                echo 'Aucune image trouvée dans le dossier.';
            }
            ?>
        </div>

        <img src="" id="last1"></img>
    </article>
        <?php  echo '<script src="../../JS/Upload_IMG.js"></script>'; ?>

       <!-- var lastclickimg="last1" -->

