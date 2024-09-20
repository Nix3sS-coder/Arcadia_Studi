<?php

use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        // Simulation de la connexion à une base de données avec PDO
        $this->pdo = $this->getMockBuilder(PDO::class)
                          ->disableOriginalConstructor()
                          ->getMock();
    }

    // Test pour vérifier que les services sont correctement récupérés et affichés
    public function testAffichageServices(): void {
        // Simuler le résultat d'une requête avec des données de services
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
                         ->disableOriginalConstructor()
                         ->getMock();
        $stmtMock->method('fetchAll')->willReturn([
            ['Nom' => 'Restaurant', 'Description' => 'Service de restauration rapide'],
            ['Nom' => 'Parking', 'Description' => 'Parking gratuit disponible']
        ]);

        // Simuler les variables attendues dans `infos_services.php`
        $services = [
            ['Nom' => 'Restaurant', 'Description' => 'Service de restauration rapide'],
            ['Nom' => 'Parking', 'Description' => 'Parking gratuit disponible']
        ];

        // Capturer la sortie du fichier `Services.php`
        ob_start();
        include(__DIR__ . '/../Services.php');
        $output = ob_get_clean();

        // Vérifier que la sortie contient les noms des services et les descriptions
        $this->assertStringContainsString('Restaurant', $output, "Le service 'Restaurant' doit apparaître.");
        $this->assertStringContainsString('Service de restauration rapide', $output, "La description du service 'Restaurant' doit apparaître.");
        $this->assertStringContainsString('Parking', $output, "Le service 'Parking' doit apparaître.");
        $this->assertStringContainsString('Parking gratuit disponible', $output, "La description du service 'Parking' doit apparaître.");
    }

    // Test pour vérifier le comportement quand aucun service n'est présent
    public function testAucunService(): void {
        // Simuler un résultat vide
        $services = [];

        // Capturer la sortie du fichier `Services.php`
        ob_start();
        include(__DIR__ . '/../Services.php');
        $output = ob_get_clean();

        // Vérifier que la sortie ne contient aucun service
        $this->assertStringNotContainsString('<article class="bgelt">', $output, "Aucun service ne doit être affiché si la base est vide.");
    }

    // Test pour vérifier le comportement en cas d'erreur dans la requête
    public function testErreurRequete(): void {
        // Simuler une exception PDO
        $this->pdo->method('prepare')->will($this->throwException(new PDOException("Erreur de base de données")));

        // Simuler une variable vide car la requête échoue
        $services = [];

        // Capturer la sortie du fichier `Services.php`
        ob_start();
        include(__DIR__ . '/../Services.php');
        
        $output = ob_get_clean();

        // Vérifier que la sortie contient un message d'erreur
        $this->assertStringContainsString('Erreur', $output, "Un message d'erreur doit être affiché en cas de problème.");
    }
}
