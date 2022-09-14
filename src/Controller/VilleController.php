<?php

namespace App\Controller;

use App\Form\RechercheVilleType;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="app_ville")
     */
    public function list(Request $request,VilleRepository $villeRepository): Response
    {
        $villes =$villeRepository->findAll();

        $rechercheVilleForm =$this->createForm(RechercheVilleType::class,$villes);
        return $this->render('ville/ville.html.twig', [
            'controller_name' => 'VilleController',

            "villes"=>$villes,
        ]);
    }
    public function recherche()
    {

    }
}
