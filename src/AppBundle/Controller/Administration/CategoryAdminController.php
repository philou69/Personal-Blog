<?php


namespace AppBundle\Controller\Administration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryAdminController extends Controller
{
    public function indexAction()
    {
        return $this->render(':Admin/Category:index.html.twig');
    }
}