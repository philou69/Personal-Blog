<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Bienvenue sur mon blog', $crawler->filter('h1')->text());
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\AppController::listAction', $client->getRequest()->attributes->get('_controller'));
        $this->assertContains('Liste des categories', $crawler->filter('h1')->text());
        $this->assertContains('Aucunes catégories pour l\'instant', $crawler->filter('div')->text());
    }
}
