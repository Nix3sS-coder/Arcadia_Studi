<?php

use PHPUnit\Framework\TestCase;

class IndexHabitatTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        // Simulation de la connexion à une base de données avec PDO
        $this->pdo = $this->getMockBuilder(PDO::class)
                          ->disableOriginalConstructor()
                          ->getMock();
    }

    // Test pour vérifier que les habitats sont correctement récupérés et affichés
    public function testAffichageHabitats(): void {
        // Simuler le résultat d'une requête avec des données d'habitat
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        $stmtMock->method('fetchAll')->willReturn([
            ['Nom' => 'Savane'],
            ['Nom' => 'Forêt tropicale']
        ]);

        // Simuler les variables attendues dans `index_recup_habitat.php`
        $habitat = [
            ['Nom' => 'Savane'],
            ['Nom' => 'Forêt tropicale']
        ];
        $listfirstphoto = ['savane.jpg', 'foret_tropicale.jpg'];

        // Capturer la sortie du fichier `index_recup_habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/index_recup_habitat.php');
        $output = ob_get_clean();

        // Vérifier que la sortie contient les noms des habitats et les images
        $this->assertStringContainsString('Savane', $output, "Le nom de l'habitat 'Savane' doit apparaître.");
        $this->assertStringContainsString('Forêt tropicale', $output, "Le nom de l'habitat 'Forêt tropicale' doit apparaître.");
        $this->assertStringContainsString('savane.jpg', $output, "L'image 'savane.jpg' doit apparaître.");
        $this->assertStringContainsString('foret_tropicale.jpg', $output, "L'image 'foret_tropicale.jpg' doit apparaître.");
    }

    // Test pour vérifier le comportement quand aucun habitat n'est présent
    public function testAucunHabitat(): void {
        // Simuler un résultat vide
        $habitat = [];
        $listfirstphoto = [];

        // Capturer la sortie du fichier `index_recup_habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/index_recup_habitat.php');
        $output = ob_get_clean();

        // Vérifier que la sortie contient un message ou une structure vide
        $this->assertStringNotContainsString('<h3 class="nomhab">', $output, "Aucun habitat ne doit être affiché si la base est vide.");
    }

    // Test pour vérifier le comportement en cas d'erreur dans la requête
    public function testErreurRequete(): void {
        // Simuler une exception PDO
        $this->pdo->method('prepare')->will($this->throwException(new PDOException("Erreur de base de données")));

        // Simuler une variable vide car la requête échoue
        $habitat = [];
        $listfirstphoto = [];

        // Capturer la sortie du fichier `index_recup_habitat.php`
        ob_start();
        include(__DIR__ . '/../PHP/Vue/index_recup_habitat.php');
        $output = ob_get_clean();

        // Vérifier que la sortie contient un message d'erreur
        $this->assertStringContainsString('Erreur', $output, "Un message d'erreur doit être affiché en cas de problème.");
    }
}
