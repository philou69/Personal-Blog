<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryAdminControllerTest extends WebTestCase
{
    public function testIndex(){
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/category/index');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des catégories', $crawler->filter('h1')->text());
    }
}