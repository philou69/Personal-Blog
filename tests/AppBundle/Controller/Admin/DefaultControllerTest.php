<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultControllerTest extends WebTestCase
{
    protected $client = null;

    public function setUp()
    {
        $this->client = $this->logIn();
    }

    private function logIn()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/connect');

        $form = $crawler->selectButton('Se connecter')->form();

        $form['_username'] = 'philou';
        $form['_password'] = 'test';

        $client->submit($form);
        $client->followRedirect();

        return $client;
    }
}