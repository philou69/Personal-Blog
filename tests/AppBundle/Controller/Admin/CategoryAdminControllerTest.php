<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryAdminControllerTest extends WebTestCase
{
    /**
     * Test fonctionnel sur l'index des categories en administration
     */
    public function testIndex()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/category/index');
        // Pour l'heure le code retour un 302,
        // Il faut connecter le visiteur
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des catégories', $crawler->filter('h1')->text());
    }
}