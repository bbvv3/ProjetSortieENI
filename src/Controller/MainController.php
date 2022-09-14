<?php

namespace App\Controller;

use App\Form\MainType;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;
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
    public function home(Request $request, SortieRepository $sortieRepository, EtatRepository $etatRepository): Response
    {
        $mainForm = $this->createForm(MainType::class);

        $sorties = $sortieRepository->findAll();
        $etats =  $etatRepository->findAll();
        //$query = "SELECT id, nom
        //            FROM etat
        //            INNER JOIN sortie
        //            ON etat.libelle = sortie.id"

        return $this->render('home/home.html.twig', [
           // 'controller_name' => 'MainController',
            'mainForm'=>$mainForm->createView(),
            "sorties" => $sorties,
            "etats" => $etats,
        ]);
    }
}
