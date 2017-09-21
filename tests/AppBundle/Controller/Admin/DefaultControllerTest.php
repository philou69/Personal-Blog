<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class DefaultControllerTest
 * @package Tests\AppBundle\Controller\Admin
 * Class de controller Admin pour la connection de l'administrateur
 */
class DefaultControllerTest extends WebTestCase
{
    protected $client = null;

    public function setUp()
    {
        $this->client = $this->logIn();
    }

    /**
     * Fonction pour connecter l'administrateur
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
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