<?php


namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction( )
    {
        return $this->render(':Admin:index.html.twig');
    }

}