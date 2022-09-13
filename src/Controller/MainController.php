<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="app")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="_home")
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @return ("login", name="login")
     */
    public function login()
    {
        if (false === $this->getUser('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return new RedirectResponse('/', 403);
        }
        return $this->render('security/login.html.twig');
    }
}
