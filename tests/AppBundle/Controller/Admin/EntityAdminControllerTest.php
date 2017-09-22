<?php


namespace Tests\AppBundle\Controller\Admin;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntityAdminControllerTest extends DefaultControllerTest
{
    /**
     * @expectedException
     */
    public function testWrongRoute()
    {
        $client = $this->client;

        $client->request('GET', '/admin/erter/');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * @expectedException
     */
    public function testWrongRouteCreate()
    {
        $client = $this->client;

        $client->request('GET', '/admin/wrongentityname/create');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * @expectedException
     */
    public function testWrongRouteEdit()
    {
        $client = $this->client;

        $client->request('GET', '/admin/wrongentityname/fake-slug/edit');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * @expectedException
     */
    public function testWrongRoutedelete()
    {
        $client = $this->client;

        $client->request('GET', '/admin/wrongentityname/delete');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * @expectedException
     */
    public function testWrongSlugEdit()
    {
        $client = $this->client;

        $client->request('GET', '/admin/post/fake-slug/edit');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());

        $client->request('POST', '/admin/post/fake-slug/edit');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }

    /**
     * @expectedException
     */
    public function testWrongIdDelete()
    {
        $client = $this->client;
        $client->request('GET', '/admin/post/delete');
        $this->assertEquals(405, $client->getResponse()->getStatusCode());

        $client->request('POST', '/admin/post/delete', ['id' => 'fakeid']);
        $this->assertEquals(403, $client->getResponse()->getStatusCode());

        $client->request('POST', '/admin/post/delete', ['id' => null]);
        $this->assertEquals(403, $client->getResponse()->getStatusCode());

        $client->request('POST', '/admin/post/delete');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}