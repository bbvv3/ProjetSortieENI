<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\MainType;
use App\Models\Filtres;
use App\Repository\CampusRepository;
use App\Repository\EtatRepository;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        //création et récupération des filtres
        $mainForm = $this->createForm(MainType::class);
        $mainForm->handleRequest($request);
        //if($mainForm->isSubmitted() && $mainForm->isValid()){ }

        //récupération du campus de l'utilisateur
        $campus = $this->getUser()->getCampus();
        $filtres = new Filtres();
        $filtres->setCampus($campus);
        //recupération du tableau de sorties
        $sorties = $sortieRepository->findSortieHome($filtres);

        //redirection vers la page
        return $this->render('home/home.html.twig', [
            'mainForm'=>$mainForm->createView(),
            "sorties" => $sorties,
        ]);
    }

    /**
     * @Route("inscrire/{id}", name="_inscrire")
     */
    public function inscrire(int $id, Request $request, EntityManagerInterface $entityManager, SortieRepository $sortieRepository): Response
    {
        $inscrireSortie = $sortieRepository->find($id);
        $inscrireSortie->addParticipant($this->getUser());

        $entityManager->persist($inscrireSortie);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
