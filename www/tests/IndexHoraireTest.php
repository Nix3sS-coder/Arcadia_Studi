<?php

use PHPUnit\Framework\TestCase;

class IndexHoraireTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Connexion à la base de données
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si la table 'horaire' est vide
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM horaire");
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si aucun horaire n'est présent, ajouter des horaires de test
        if ($resultat['count'] == 0) {
            $this->ajouterHoraireTest();
        }
    }

    // Méthode pour ajouter des horaires de test si la table est vide
    private function ajouterHoraireTest(): void
    {
        // Formatage des données horaires pour insérer dans la base de données
        $stmt = $this->pdo->prepare("INSERT INTO horaire (lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            '08:00/12:00/13:00/17:00', // Lundi
            '08:00/12:00/13:00/17:00', // Mardi
            '08:00/12:00/13:00/17:00', // Mercredi
            '08:00/12:00/13:00/17:00', // Jeudi
            '08:00/12:00/13:00/17:00', // Vendredi
            '08:00/12:00/13:00/17:00', // Samedi
            '08:00/12:00/13:00/17:00'  // Dimanche
        ]);
    }

    // Test de la récupération des horaires
    public function testRecuperationHoraires(): void
    {
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Index_Horaire.php');
        $output = ob_get_clean();
        
        // Vérifier que les variables sont présentes dans le HTML généré
        $this->assertStringContainsString('<table>', $output, "La table des horaires devrait être présente dans la sortie.");
        $this->assertStringContainsString('Début de journée', $output, "La ligne 'Début de journée' devrait être présente dans la sortie.");
        $this->assertStringContainsString('Reprise déjeuner', $output, "La ligne 'Reprise déjeuner' devrait être présente dans la sortie.");
        $this->assertStringContainsString('Déjeuner', $output, "La ligne 'Déjeuner' devrait être présente dans la sortie.");
        $this->assertStringContainsString('Fin de journée', $output, "La ligne 'Fin de journée' devrait être présente dans la sortie.");
    }

    // Test des horaires manquants
    public function testHorairesManquants(): void
    {
        // Simuler la suppression de certaines horaires pour tester le comportement en cas d'horaires manquants
        $this->pdo->exec("UPDATE horaire SET lundi = '////' WHERE 1");

        ob_start();
        include(__DIR__ . '/../PHP/Vue/Index_Horaire.php');
        $output = ob_get_clean();

        // Vérifier la présence de messages ou éléments indiquant les horaires manquants
        $this->assertStringContainsString('<td></td>', $output, "Des horaires manquants devraient être visibles dans la sortie.");
    }

    // Test des horaires incorrects
    public function testHorairesIncorrects(): void
    {
        // Insérer des horaires avec des valeurs incorrectes pour tester le comportement
        $this->pdo->exec("UPDATE horaire SET lundi = '08:00///17:00', mardi = '08:00///17:00', mercredi = '08:00///17:00', jeudi = '08:00///17:00', vendredi = '08:00///17:00', samedi = '08:00///17:00', dimanche = '08:00///17:00' WHERE 1");
        
        ob_start();
        include(__DIR__ . '/../PHP/Vue/Index_Horaire.php');
        $output = ob_get_clean();
    
        // Vérifiez que les horaires incorrects ne sont pas affichés
        $this->assertStringNotContainsString('08:00///17:00', $output, "Les horaires incorrects ne devraient pas être visibles dans la sortie.");
    }
}
