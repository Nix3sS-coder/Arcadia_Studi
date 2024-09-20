<?php

use PHPUnit\Framework\TestCase;

class HabitatDetailTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        // Création d'un mock pour la connexion à la base de données
        $this->pdo = $this->getMockBuilder(PDO::class)
                          ->disableOriginalConstructor()
                          ->getMock();
    }

    public function testHabitatDetails(): void {
        // Simuler les détails des animaux
        $animaux = [
            ['ID' => 1, 'Prenom' => 'Leo', 'race' => 'Lion']
        ];
        $photosliste = [
            ['photo1.jpg', 'photo2.jpg']
        ];
        $listphoto = [
            'photo1.jpg' => ['Fichier' => 'photo1.jpg'],
            'photo2.jpg' => ['Fichier' => 'photo2.jpg']
        ];

        // Mock pour la méthode `fetchAll` de PDOStatement
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        $stmtMock->method('fetchAll')->willReturn($animaux);

        // Mock pour la connexion PDO
        $this->pdo->method('prepare')->willReturn($stmtMock);

        // Simuler la connexion à la base de données
        $GLOBALS['animaux'] = $animaux;
        $GLOBALS['photosliste'] = $photosliste;
        $GLOBALS['listphoto'] = $listphoto;

        // Simuler le paramètre GET
        $_GET['habitat'] = 1;

        // Capturer la sortie du fichier `Habitat_detail_habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Habitat_detail_habitat.php');
        $output = ob_get_clean();

        // Vérifier que les détails de l'animal sont correctement affichés
        $this->assertStringContainsString('Leo', $output, "Le prénom de l'animal doit être 'Leo'.");

        // Vérifier que les photos sont affichées
        foreach ($photosliste[0] as $photo) {
            $this->assertStringContainsString('src="Assets/Ajouts/' . $photo . '"', $output, "La photo '$photo' doit être affichée.");
        }

        // Test avec un ID incorrect
        $_GET['habitat'] = 999;

        // Capturer la sortie du fichier `Habitat_detail_habitat.php` pour un ID incorrect
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Habitat_detail_habitat.php');
        $output = ob_get_clean();

        // Vérifier que le message d'erreur est affiché en cas d'ID incorrect
        $this->assertStringContainsString('Erreur', $output, "Un message d'erreur doit être affiché pour un ID incorrect.");
    }
}
