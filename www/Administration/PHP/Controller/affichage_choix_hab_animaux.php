<?php

try {
    include("PHP/Model/infosbase.php");

    // Requête SQL pour récupérer les habitats
    $stmt = $conn->prepare("SELECT * FROM habitat");
    $stmt->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Requête SQL pour récupérer les animaux
    $stmt2 = $conn->prepare("SELECT * FROM animaux");
    $stmt2->execute();
    
    // Définir le jeu de résultats sous forme de tableau associatif
    $resultat2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Initialiser les listes et le dictionnaire
    $listhabitat = [];
    $listannimaux = [];
    $dicoanimaux = [];

    // Parcourir les habitats et les animaux pour remplir les listes et le dictionnaire
    foreach ($resultat as $habitat) {
        foreach ($resultat2 as $animaux) {
            if ($animaux['habitat_ID'] == $habitat['ID']) {
                //echo $animaux['ID'];
                array_push($listannimaux,$animaux);
                $dicoanimaux[$habitat['ID']][] = $animaux;
            }
        }
        array_push($listhabitat,$habitat);
    }

    echo"<div>";
    echo"<p>Choix habitat</p>";
    // Générer le sélecteur d'habitats
    echo '<select name="habitat" id="habitat-select">';
    echo '<option value="0">Tous</option>';

    foreach ($listhabitat as $habitat) {
        echo '<option value="' . $habitat['ID'] . '">' . $habitat['Nom'] . '</option>';
    }
    echo '</select>';
    echo "</div>";

    //Générer le sélecteur d'animaux
    echo"<div>";
    echo"<p>Choix animaux</p>";
    echo '<select name="pets" id="pet-select">';
    echo '<option value="0">Tous</option>';
    foreach ($listannimaux as $animaux) {
        echo '<option value="' . $animaux['ID'] . '">' . $animaux['Prenom'].', '.$animaux['race'] . '</option>';
    }
    echo '</select>';
    echo "</div>";

        // Convertir le dictionnaire d'animaux en JSON pour utilisation dans JavaScript
        $dicoanimaux_json = json_encode($dicoanimaux);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>

<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var habitatSelect = document.getElementById('habitat-select');
            var petSelect = document.getElementById('pet-select');
            var allOptions = Array.from(petSelect.options); // Save all options initially

            // Convertir le dictionnaire d'animaux en JSON en variable JavaScript
            var dicoanimaux = <?php echo $dicoanimaux_json; ?>;

            habitatSelect.addEventListener('change', function () {
                var selectedHabitat = this.value;

                // Remove all options except the first one (Tous)
                while (petSelect.options.length > 1) {
                    petSelect.remove(1);
                }

                if (selectedHabitat == "0") {
                    // Show all animals if "Tous" is selected
                    allOptions.forEach(function (option) {
                        if (option.value != "0") {
                            petSelect.appendChild(option);
                        }
                    });
                } else {
                    // Show only animals that belong to the selected habitat
                    var selectedAnimals = dicoanimaux[selectedHabitat] || [];
                    selectedAnimals.forEach(function (animal) {
                        var option = document.createElement('option');
                        option.value = animal.ID;
                        option.textContent = animal.Prenom +', '+animal.race;
                        petSelect.appendChild(option);
                    });
                }
            });
        });
    </script>