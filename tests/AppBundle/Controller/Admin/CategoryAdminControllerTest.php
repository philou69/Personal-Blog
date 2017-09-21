<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryAdminControllerTest extends DefaultControllerTest
{
    /**
     * Test fonctionnel sur l'index des categories en administration
     */
    public function testIndex()
    {

        $client = $this->client;

        $crawler = $client->request('GET', '/admin/category/index');
        // Pour l'heure le code retour un 302,
        // Il faut connecter le visiteur
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des catégories', $crawler->filter('h1')->text());
    }

    /**
     * Test sur la création d'une categorie
     */
    public function testCreate()
    {
        $client = $this->client;

        $crawler = $client->request('GET', 'admin/category/create');

        $form = $crawler->selectButton('Enregistrer')->form();

        $form['category[category]'] = 'PHP test';

        $client->submit($form);

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\Administration\EntityAdminController::indexAction', $client->getRequest()->attributes->get('_controller'));
    }

    /**
     * Test sur la modification d'une categorie
     */
    public function testEdit()
    {
        $client = $this->client;

        $crawler = $client->request('GET', 'admin/category/php-test/edit');

        $form = $crawler->selectButton('Enregistrer')->form();

        $form['edit_category[category]'] = 'PHP test21';

        $client->submit($form);

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\Administration\EntityAdminController::indexAction', $client->getRequest()->attributes->get('_controller'));
    }

    /**
     * Test sur la suppresion d'une categorie
     */
    public function testDelete()
    {
        $client = $this->client;
        $crawler = $client->request('GET', '/admin/category/index');

        $this->assertContains('PHP test21', $client->getResponse()->getContent());

        $form = $crawler->filter('button#delete-php-test21')->form();

        $crawler = $client->submit($form);

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}