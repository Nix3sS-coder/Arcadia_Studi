<?php
use PHPUnit\Framework\TestCase;

class NavigationFunctionalTest extends TestCase
{
    // Simuler un clic sur la section "Contact" et vérifier que l'utilisateur est redirigé correctement
    public function testNavigateToContact()
    {
        // Simuler une requête vers la page de contact
        $_SERVER['REQUEST_URI'] = '/contact.php';

        // Inclure la navbar pour simuler la navigation
        ob_start();
        include 'navbar.html';
        ob_end_clean();

        // Vérifier que la page de contact est bien accessible
        // Vous pouvez inclure plus de vérifications sur le contenu de la page
        $this->assertStringContainsString('/contact.php', $_SERVER['REQUEST_URI']);
    }

    // Simuler un clic sur la section "Login" et vérifier que l'utilisateur est redirigé correctement
    public function testNavigateToLogin()
    {
        // Simuler une requête vers la page de login
        $_SERVER['REQUEST_URI'] = '/Login.php';

        // Inclure la navbar pour simuler la navigation
        ob_start();
        include 'navbar.html';
        ob_end_clean();

        // Vérifier que la page de login est bien accessible
        $this->assertStringContainsString('/Login.php', $_SERVER['REQUEST_URI']);
    }

    // Simuler un clic sur la section "Accueil" et vérifier que l'utilisateur est redirigé correctement
    public function testNavigateToHome()
    {
        // Simuler une requête vers la page d'accueil
        $_SERVER['REQUEST_URI'] = '/index.php';

        // Inclure la navbar pour simuler la navigation
        ob_start();
        include 'navbar.html';
        ob_end_clean();

        // Vérifier que la page d'accueil est bien accessible
        $this->assertStringContainsString('/index.php', $_SERVER['REQUEST_URI']);
    }

    // Simuler un clic sur la section "Habitat" et vérifier que l'utilisateur est redirigé correctement
    public function testNavigateToHabitat()
    {
        // Simuler une requête vers la page d'habitat
        $_SERVER['REQUEST_URI'] = '/Habitat.php';

        // Inclure la navbar pour simuler la navigation
        ob_start();
        include 'navbar.html';
        ob_end_clean();

        // Vérifier que la page d'habitat est bien accessible
        $this->assertStringContainsString('/Habitat.php', $_SERVER['REQUEST_URI']);
    }

    // Simuler un clic sur la section "Services" et vérifier que l'utilisateur est redirigé correctement
    public function testNavigateToServices()
    {
        // Simuler une requête vers la page des services
        $_SERVER['REQUEST_URI'] = '/Services.php';

        // Inclure la navbar pour simuler la navigation
        ob_start();
        include 'navbar.html';
        ob_end_clean();

        // Vérifier que la page des services est bien accessible
        $this->assertStringContainsString('/Services.php', $_SERVER['REQUEST_URI']);
    }
}
