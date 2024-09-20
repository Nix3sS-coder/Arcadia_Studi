<?php

use PHPUnit\Framework\TestCase;

class IndexAvisTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        // Connexion à la base de données
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=arcadia', 'root', 'PasswordForRoot@2023!');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Créer la table `avis` si elle n'existe pas
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `avis` (
            `ID` int NOT NULL AUTO_INCREMENT,
            `Pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Avis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            `Valider` tinyint(1) NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

        // Vérifier si la table 'avis' est vide
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM avis");
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si aucun avis n'est présent, ajouter des avis de test
        if ($resultat['count'] == 0) {
            $this->ajouterAvisTest();
        }
    }

    // Méthode pour ajouter des avis de test si la table est vide
    private function ajouterAvisTest(): void {
        $this->pdo->exec("INSERT INTO avis (Pseudo, Avis, Valider) VALUES ('John Doe', 'A great experience!', 0)");
        $this->pdo->exec("INSERT INTO avis (Pseudo, Avis, Valider) VALUES ('Jane Smith', 'Loved the zoo!', 0)");
    }

    // Test de la récupération des avis
    public function testRecuperationAvis(): void {
        $stmt = $this->pdo->query("SELECT * FROM avis");
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affiche les résultats pour vérification
        //var_dump($resultat); 

        // Vérifications des résultats
        $this->assertIsArray($resultat, "La récupération des avis devrait retourner un tableau.");
        $this->assertNotEmpty($resultat, "La récupération des avis devrait retourner des avis.");
        $this->assertCount(2, $resultat, "Il devrait y avoir 2 avis.");
    }

    // Test lorsque aucun avis n'est disponible
    public function testAucunAvisDisponible(): void {
        // Supprimer tous les avis pour tester le cas où il n'y a pas d'avis
        $this->pdo->exec("DELETE FROM avis");

        $stmt = $this->pdo->query("SELECT * FROM avis");
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérification des résultats
        $this->assertEmpty($resultat, "La récupération des avis devrait retourner un tableau vide lorsque aucun avis n'est disponible.");
    }
}
