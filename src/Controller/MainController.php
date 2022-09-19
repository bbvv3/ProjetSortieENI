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
    public function home(Request $request, SortieRepository $sortieRepository, ParticipantRepository $participantRepository): Response
    {
        $mail = $this->getUser()->getUserIdentifier();
        $utilisateur = new Participant();
        $utilisateur = $participantRepository->findBy(['mail'=>$mail]);
        $campus = $utilisateur->getCampus();

        $rechercherSortie = new RechercherSortie($mail);
        $mainForm = $this->createForm(MainType::class, $rechercherSortie);
        $mainForm->handleRequest($request);
        $sorties = $sortieRepository->findAll();
        return $this->render('home/home.html.twig', [
            'mainForm'=>$mainForm->createView(),
            "sorties" => $sorties,
        ]);
    }
}
