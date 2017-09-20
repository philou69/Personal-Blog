<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * Action pour afficher un formulaire de connection
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connectAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // Récuperation des erreurs de log
        $errors = $authenticationUtils->getLastAuthenticationError();

        // Récuperation du dernier username
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(':User:connect.html.twig', ['errors' => $errors, 'lastUsername' => $lastUsername]);
        
    }

}