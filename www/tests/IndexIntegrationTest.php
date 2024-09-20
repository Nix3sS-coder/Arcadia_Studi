<?php

use PHPUnit\Framework\TestCase;

class IndexIntegrationTest extends TestCase
{

    public function testIndexDisplaysHabitatsAndAvisSuccessfully()
    {
        // Simuler les données d'avis
        $resultat = [
            ['Pseudo' => 'John Doe', 'Avis' => 'Excellent zoo!'],
            ['Pseudo' => 'Jane Smith', 'Avis' => 'Great experience!']
        ];
        
        // Simuler la variable $habitat
        $habitat = [
            ['Nom' => 'Savane', 'idphoto' => 'photo1.jpg'],
            ['Nom' => 'Forêt', 'idphoto' => 'photo2.jpg']
        ];
        
        // Simuler la variable $listfirstphoto
        $listfirstphoto = 'photo1.jpg';
        
        // Capture la sortie de index.php
        ob_start();
        include(__DIR__ . '/../index.php');
        $output = ob_get_clean();
        
        // Vérifier que les habitats sont affichés correctement
        $this->assertStringContainsString('Habitat', $output);
        $this->assertStringContainsString('<h3 class="nomhab">', $output);
        
        // Vérifier que les avis sont affichés correctement
        $this->assertStringContainsString('Avis', $output);
        $this->assertStringContainsString('<p class="avis">', $output);
    }
    

    public function testIndexHandlesFailedHabitatRetrieval()
    {
        // Simuler un échec de récupération d'habitat (par exemple en mockant la base de données)
        // Ici, on pourrait utiliser ob_start et ob_get_clean pour capturer la sortie
        // Simuler l'absence de la variable $habitat
        $habitat = []; // Tableau vide pour simuler l'absence de données
        $resultat = [];

        ob_start();
        // Simuler l'absence de la variable `$habitat`
        include(__DIR__ . '/../index.php');
        $output = ob_get_clean();

        // Vérifier que le message d'erreur est affiché
        $this->assertStringContainsString('Erreur', $output);
    }

    public function testIndexHandlesFailedAvisRetrieval()
    {
        // Simuler l'absence de la variable $habitat
        $resultat = [];  // Tableau vide pour simuler l'absence de données
        $habitat = [];
        // Simuler un échec de récupération d'avis
        ob_start();
        // Simuler l'absence de la variable `$resultat`
        include(__DIR__ . '/../index.php');
        $output = ob_get_clean();

        // Vérifier que le message d'erreur est affiché
        $this->assertStringContainsString('Erreur', $output);
    }
}
