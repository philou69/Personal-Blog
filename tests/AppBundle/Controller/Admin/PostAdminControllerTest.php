<?php


namespace Tests\AppBundle\Controller\Admin;


class PostAdminControllerTest extends DefaultControllerTest
{
    public function testIndex()
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/admin/post/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Liste des articles', $client->getResponse()->getContent());
    }

    public function testCreate()
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/admin/post/create');

        $form = $crawler->selectButton("Enregistrer")->form();

        $form['post[title]'] = 'post test';
        $form['post[content]'] = "Post de test pour s'assurer que tous fonctionne";
        $form['post[category]'] = 'category-test';

        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('post test', $client->getResponse()->getContent());
    }

    public function testEdit()
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/admin/post/');

        $link = $crawler->selectLink('post test')->link();

        $crawler = $client->click($link);

        $this->assertEquals('AppBundle\Controller\Administration\EntityAdminController::editAction', $client->getRequest()->attributes->get('_controller'));

        $form = $crawler->selectButton('Enregistrer')->form();


        $form['edit_post[title]'] = 'test post';
        $form['edit_post[content]'] = $crawler->filter('textarea#edit_post_content')->text() . "et si on peut le modifier";

        $client->submit($form);

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('test post', $client->getResponse()->getContent());
    }

    public function testDelete()
    {
        $client = $this->client;

        $crawler = $client->request('GET', '/admin/post/');

        $form = $crawler->filter('button#delete-test-post')->form();

        $client->submit($form);

        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotContains('test post', $client->getResponse()->getContent());
    }
}