<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{

    /**
     * Test fonctionnel sur la page d'accueil
     */
    public function testIndex()
    {
        $client = static::createClient();

        // On va sur la page /
        $crawler = $client->request('GET', '/');

        // on s'assure que le code de retour est 200 et que la vue contient 'Bienvenue sur mon blog'
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Bienvenue sur mon blog', $crawler->filter('h1')->text());
    }

    /**
     * Test Fonctionnel sur la page de liste de categorie
     */
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');

        // On verifie le code de statusn le controller et le contenu de la page
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\AppController::listAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Liste des categories', $crawler->filter('h1')->text());
    }

    /**
     * Test fonctionnel de connection d'un visiteur
     */
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request("GET", '/user/connect');

        // On recupere le form de connection
        $form = $crawler->selectButton('Se connecter')->form();

        $form['_username'] = 'Philou';
        $form['_password'] = 'test';

        // Après l'avoir remplis, on le soumets
        $client->submit($form);

        $client->followRedirect(true);

        // on verifie le code de retour et la route.
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('app_home', $client->getRequest()->attributes->get('_route'));
    }
}
