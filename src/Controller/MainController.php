<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\MainType;
use App\Models\RechercherSortie;
use App\Repository\EtatRepository;
use App\Repository\ParticipantRepository;
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
    public function home(Request $request, SortieRepository $sortieRepository): Response
    {
        //$mainForm = $this->createForm(MainType::class);
        //$mainForm->handleRequest($request);
        $sorties = $sortieRepository->findAll();
        return $this->render('home/home.html.twig', [
            //'mainForm'=>$mainForm->createView(),
            "sorties" => $sorties,
        ]);
    }
}
