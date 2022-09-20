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
    public function inscrire(int $id, Request $request, ParticipantRepository $participantRepository, EtatRepository $etatRepository, EntityManagerInterface $entityManager, SortieRepository $sortieRepository): Response
    {
        $inscrireSortie = $sortieRepository->find($id);
        if (count($inscrireSortie->getParticipants()) == $inscrireSortie->getNbInscriptionsMax() -1) {
            $inscrireSortie->addParticipant($this->getUser());
            $etat = $etatRepository->findOneBy(['libelle' => 'Clôturée']);
            $inscrireSortie->setEtatSortie($etat);
            $entityManager->persist($inscrireSortie);
        } else if (count($inscrireSortie->getParticipants()) < $inscrireSortie->getNbInscriptionsMax()) {
            $inscrireSortie->addParticipant($this->getUser());
            $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
            $inscrireSortie->setEtatSortie($etat);
            $entityManager->persist($inscrireSortie);
        }
        // todo : sortie.organisateur != app.user and (sortie.dateLimiteInscription) < 'now'
        $entityManager->flush();
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/desister/{id}", name="_desister")
     */
    public function seDesister(int $id, Request $request, SortieRepository $sortieRepository, EntityManagerInterface $entityManager):Response
    {
        $seDesisterSortie = $sortieRepository->find($id);
        $seDesisterSortie->removeParticipant($this->getUser());

        $entityManager->persist($seDesisterSortie);
        $entityManager->flush();

        return $this->redirectToRoute( 'app_home');
    }

    /**
     * @Route("/publier/{id}", name="_publier")
     */
    public function publier(int $id, Request $request, SortieRepository $sortieRepository, EntityManagerInterface $entityManager):Response
    {
        $publierSortie = $sortieRepository->find($id);
        $publierSortie->removeParticipant($this->getEtatSortie());

        $publierSortie->setEtatSortie($etat);
        $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);

        $entityManager->persist($publierSortie);
        $entityManager->flush();

        return $this->redirectToRoute( 'app_home');
    }
}
