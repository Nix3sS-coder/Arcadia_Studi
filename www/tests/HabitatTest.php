<?php

use PHPUnit\Framework\TestCase;

class HabitatTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        // Mock de la connexion à la base de données avec PDO
        $this->pdo = $this->getMockBuilder(PDO::class)
                          ->disableOriginalConstructor()
                          ->getMock();
    }

    // Test pour vérifier que tous les habitats sont bien récupérés et affichés
    public function testAffichageHabitats(): void {
        // Simuler la récupération des habitats avec leurs descriptions et photos
        global $habitat, $photosliste, $listphoto;

        $habitat = [
            ['ID' => 1, 'Nom' => 'Savane', 'description' => 'Habitat des lions'],
            ['ID' => 2, 'Nom' => 'Forêt', 'description' => 'Habitat des singes']
        ];

        // Simuler le tableau des photos
        $photosliste = [
            [0 => 0],
            [1 => 1]
        ];

        $listphoto = [
            ['Fichier' => 'lion.jpg'],
            ['Fichier' => 'singe.jpg']
        ];

        // Capturer la sortie du fichier `Habitat_recup_Habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Habitat_recup_Habitat.php');
        $output = ob_get_clean();

        // Vérifier que les informations sont affichées correctement
        $this->assertStringContainsString('Savane', $output, "L'habitat 'Savane' doit apparaître.");
        $this->assertStringContainsString('Habitat des lions', $output, "La description de l'habitat 'Savane' doit apparaître.");
        $this->assertStringContainsString('Forêt', $output, "L'habitat 'Forêt' doit apparaître.");
        $this->assertStringContainsString('Habitat des singes', $output, "La description de l'habitat 'Forêt' doit apparaître.");
        $this->assertStringContainsString('lion.jpg', $output, "L'image 'lion.jpg' doit apparaître.");
        $this->assertStringContainsString('singe.jpg', $output, "L'image 'singe.jpg' doit apparaître.");
    }

    // Test pour vérifier le comportement lorsque certains habitats manquent
    public function testHabitatManquant(): void {
        // Simuler la récupération avec un habitat manquant
        global $habitat, $photosliste, $listphoto;

        $habitat = [
            ['ID' => 1, 'Nom' => 'Savane', 'description' => 'Habitat des lions']
        ];

        $photosliste = [
            [0 => 0] // Seulement la première photo pour le premier habitat
        ];

        $listphoto = [
            ['Fichier' => 'lion.jpg']
        ];

        // Capturer la sortie du fichier `Habitat_recup_Habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Habitat_recup_Habitat.php');
        $output = ob_get_clean();

        // Vérifier que seul l'habitat "Savane" est affiché
        $this->assertStringContainsString('Savane', $output, "L'habitat 'Savane' doit apparaître.");
        $this->assertStringNotContainsString('Forêt', $output, "L'habitat 'Forêt' ne doit pas apparaître si manquant.");
    }

    // Test pour vérifier le comportement en cas de données erronées (description manquante)
    public function testDescriptionManquante(): void {
        // Simuler un habitat avec une description manquante
        global $habitat, $photosliste, $listphoto;

        $habitat = [
            ['ID' => 1, 'Nom' => 'Savane', 'description' => ''],
            ['ID' => 2, 'Nom' => 'Forêt', 'description' => 'Habitat des singes']
        ];

        $photosliste = [
            [0 => 0],
            [1 => 1]
        ];

        $listphoto = [
            ['Fichier' => 'lion.jpg'],
            ['Fichier' => 'singe.jpg']
        ];

        // Capturer la sortie du fichier `Habitat_recup_Habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Habitat_recup_Habitat.php');
        $output = ob_get_clean();

        // Vérifier que l'habitat "Savane" est affiché avec une description vide
        $this->assertStringContainsString('Savane', $output, "L'habitat 'Savane' doit apparaître.");
        $this->assertStringNotContainsString('Habitat des lions', $output, "La description de 'Savane' ne doit pas apparaître si elle est vide.");
        $this->assertStringContainsString('Forêt', $output, "L'habitat 'Forêt' doit apparaître.");
        $this->assertStringContainsString('Habitat des singes', $output, "La description de l'habitat 'Forêt' doit apparaître.");
    }
}
