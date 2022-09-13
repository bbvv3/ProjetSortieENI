<?php

namespace App\Controller;

use App\Form\MainType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function rechercher(Request $request): Response
    {
        $mainForm = $this->createForm(MainType::class);

        return $this->render('home/home.html.twig', [
           // 'controller_name' => 'MainController',
            'mainForm'=>$mainForm->createView()
        ]);
    }


}
