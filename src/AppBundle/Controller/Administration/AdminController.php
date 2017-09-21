<?php


namespace AppBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction( )
    {
        return $this->render(':Admin:index.html.twig');
    }
}