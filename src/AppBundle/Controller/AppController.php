<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{

    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render(':App:index.html.twig');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAll();
        return $this->render(':App:list.html.twig', array('categories' => $categories));
    }
}
