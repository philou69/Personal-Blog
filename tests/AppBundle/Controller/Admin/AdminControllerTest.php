<?php


namespace Tests\AppBundle\Controller\Admin;


class AdminControllerTest extends DefaultControllerTest
{
    public function testIndex()
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/admin/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('AppBundle\Controller\Administration\AdminController::indexAction', $client->getRequest()->attributes->get('_controller'));
    }
}