<?php

use PHPUnit\Framework\TestCase;

class HabitatFunctionalTest extends TestCase
{
    protected static $pdo;

    public static function setUpBeforeClass(): void
    {
        try {
            self::$pdo = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // Création des tables si elles n'existent pas
            self::$pdo->exec("CREATE TABLE IF NOT EXISTS `images` (
                `ID` int NOT NULL AUTO_INCREMENT,
                `Fichier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (`ID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            self::$pdo->exec("CREATE TABLE IF NOT EXISTS `habitat` (
                `ID` int NOT NULL AUTO_INCREMENT,
                `Nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `images_liste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (`ID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            self::$pdo->exec("CREATE TABLE IF NOT EXISTS `animaux` (
                `ID` int NOT NULL AUTO_INCREMENT,
                `Prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `race` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `images_liste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `habitat_ID` int NOT NULL,
                PRIMARY KEY (`ID`),
                FOREIGN KEY (`habitat_ID`) REFERENCES `habitat`(`ID`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

            self::$pdo->exec("CREATE TABLE IF NOT EXISTS `cr_veto` (
                `ID` int NOT NULL AUTO_INCREMENT,
                `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `nourriture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `grammage` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                `date` date NOT NULL,
                `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `ID_Animal` int NOT NULL,
                PRIMARY KEY (`ID`),
                FOREIGN KEY (`ID_Animal`) REFERENCES `animaux`(`ID`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");


            // Insertion des images
            self::$pdo->exec("
                INSERT INTO images (Fichier) VALUES ('savane.jpg'), ('simba.jpg'), ('nala.jpg')
            ");

            
            // Récupération des ID des images
            $imageIds = [];
            $stmt = self::$pdo->query("SELECT ID, Fichier FROM images");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $imageIds[$row['Fichier']] = $row['ID'];
            }

            // Insertion des données de test dans `habitat`
            self::$pdo->exec("
                INSERT INTO habitat (Nom, images_liste, description) 
                VALUES ('Savane Africaine', '{$imageIds['savane.jpg']}', 'Un grand espace pour les animaux d\'Afrique.')
            ");

            $habitatId = self::$pdo->lastInsertId();

            // Insertion des données de test dans `animaux`
            self::$pdo->exec("
                INSERT INTO animaux (Prenom, race, images_liste, habitat_ID) 
                VALUES ('Simba', 'Lion', '{$imageIds['simba.jpg']}', $habitatId),
                    ('Nala', 'Lionne', '{$imageIds['nala.jpg']}', $habitatId)
            ");

            $animalIdSimba = self::$pdo->lastInsertId();

            // Insertion des données de test dans `cr_veto`
            self::$pdo->exec("
                INSERT INTO cr_veto (etat, nourriture, grammage, date, details, ID_Animal) 
                VALUES ('Bon', 'Viande', '5kg', '2024-09-19', 'Aucune blessure', $animalIdSimba)
            ");
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit;
        }
    }


    public static function tearDownAfterClass(): void
    {
        self::$pdo->exec("DELETE FROM cr_veto WHERE ID_Animal IN (SELECT ID FROM animaux WHERE Prenom = 'Simba')");
        self::$pdo->exec("DELETE FROM animaux WHERE Prenom IN ('Simba', 'Nala')");
        self::$pdo->exec("DELETE FROM habitat WHERE Nom = 'Savane Africaine'");
        self::$pdo = null;
    }

    // Test de la consultation des habitats
    public function testConsultationDesHabitats()
{
    // Déclaration des variables globales
    global $habitat, $photosliste, $listphoto;

    // Initialisation des variables
    $habitat = [
        ['ID' => 30, 'Nom' => 'Savane Africaine', 'description' => 'Un grand espace pour les animaux d\'Afrique.']
    ];

    $photosliste = [
        [67] // Indice 0 correspond à l'image (ID 67)
    ];

    $listphoto = [
        67 => ['Fichier' => 'savane.jpg'], // Remplace 'lion.jpg' par 'savane.jpg'
    ];

    // Simuler l'affichage de la page
    $output = $this->getOutputFromPage("http://localhost:8080/PHP/Vue/Habitat_recup_Habitat.php");

    // Vérifier que les informations sur l'habitat et les animaux sont présentes
    $this->assertStringContainsString('Savane Africaine', $output);
    $this->assertStringContainsString('Un grand espace pour les animaux d\'Afrique.', $output);
    $this->assertStringContainsString('<img src="Assets/Ajouts/savane.jpg">', $output); // Modifie pour matcher avec le résultat attendu
}

    
    

    
    
    

    
    

    // Test des détails d'un habitat
    public function testDetailsHabitat()
    {
        // Simuler une requête HTTP vers la page des détails de l'habitat
        $habitatId = $this->getHabitatIdByName('Savane Africaine');
        $output = $this->getOutputFromPage("http://localhost:8080/Detail_Habitat.php?habitat=$habitatId");

        // Vérifier que la page contient les animaux et leurs informations
        $this->assertStringContainsString('Simba, Lion', $output);
        $this->assertStringContainsString('Nala, Lionne', $output);
        $this->assertStringContainsString('src="Assets/Ajouts/simba.jpg"', $output);
        $this->assertStringContainsString('src="Assets/Ajouts/nala.jpg"', $output);
    }

    // Test des détails d'un animal
    public function testDetailsAnimal()
    {
        $animalIdSimba = $this->getAnimalIdByName('Simba');
        $output = $this->getOutputFromPage("http://localhost:8080/detail_animal.php?Animal=$animalIdSimba");
    
        // Vérifie la présence de certaines parties spécifiques du contenu
        $this->assertStringContainsString('<h2 class="bgelt">Simba, Lion </h2>', $output);
        $this->assertStringContainsString('<img src="Assets/Ajouts/simba.jpg">', $output);
        $this->assertStringContainsString('<p><span>Etat : </span> Bon </p>', $output);
        $this->assertStringContainsString('<p><span>Nourriture : </span> Viande </p>', $output);
        $this->assertStringContainsString('<p><span>Grammage : </span> 5kg </p>', $output);
        $this->assertStringContainsString('<p><span>Date de passage : </span> 2024-09-19 </p>', $output);
        $this->assertStringContainsString('<p><span>Detail état : </span> Aucune blessure  </p>', $output);
    }
    

    // Méthode utilitaire pour simuler une requête et obtenir le contenu de la page
    private function getOutputFromPage($url)
    {
        // Effectuer une requête HTTP GET et récupérer le contenu
        $context = stream_context_create([
            'http' => [
                'method'  => 'GET',
                'header'  => 'Accept-language: en\r\n' .
                             'User-Agent: PHPUnit\r\n',
            ],
        ]);
        return file_get_contents($url, false, $context);
    }

    // Méthode utilitaire pour récupérer l'ID d'un habitat par son nom
    private function getHabitatIdByName($name)
    {
        $stmt = self::$pdo->prepare("SELECT ID FROM habitat WHERE Nom = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetchColumn();
    }

    // Méthode utilitaire pour récupérer l'ID d'un animal par son prénom
    private function getAnimalIdByName($name)
    {
        $stmt = self::$pdo->prepare("SELECT ID FROM animaux WHERE Prenom = :name");
        $stmt->execute(['name' => $name]);
        return $stmt->fetchColumn();
    }
}
