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
use Symfony\Component\Security\Core\User\UserInterface;

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
        //récupération du campus de l'utilisateur
        $campus = $this->getUser()->getCampus();
        $filtres = new Filtres();
        $filtres->setCampus($campus);

        //création des filtres
        $mainForm = $this->createForm(MainType::class, $filtres);
        $mainForm->handleRequest($request);

        //ajout de l'utilisateur actuel

        /** @var Participant $user */
        $user=$this->getUser();

        $filtres->setUtilisateurActuel($user);

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
    public function inscrire(int $id, Request $request,
                             ParticipantRepository $participantRepository,
                             EtatRepository $etatRepository,
                             EntityManagerInterface $entityManager,
                             SortieRepository $sortieRepository): Response
    {
        $inscrireSortie = $sortieRepository->find($id);
        if (count($inscrireSortie->getParticipants()) == $inscrireSortie->getNbInscriptionsMax() -1) {
            /** @var Participant $user */
            $user=$this->getUser();

            $inscrireSortie->addParticipant($user);
            $etat = $etatRepository->findOneBy(['libelle' => 'Clôturée']);
            $inscrireSortie->setEtatSortie($etat);

        } else if (count($inscrireSortie->getParticipants()) < $inscrireSortie->getNbInscriptionsMax()) {
            /** @var Participant $user */
            $user=$this->getUser();
            $inscrireSortie->addParticipant($user);
            $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
            $inscrireSortie->setEtatSortie($etat);

        }

        $entityManager->persist($inscrireSortie);
        $entityManager->flush();
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/desister/{id}", name="_desister")
     */
    public function seDesister(int $id, Request $request, SortieRepository $sortieRepository,EtatRepository $etatRepository,EntityManagerInterface $entityManager):Response
    {
        $seDesisterSortie = $sortieRepository->find($id);
        if (count($seDesisterSortie->getParticipants()) == ($seDesisterSortie->getNbInscriptionsMax()) && $seDesisterSortie->getDateLimiteInscription() >= new \DateTime()) {
            /** @var Participant $user */
            $user=$this->getUser();
            $seDesisterSortie->removeParticipant($user);
            $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
            $seDesisterSortie->setEtatSortie($etat);

        } else if (count($seDesisterSortie->getParticipants()) <= $seDesisterSortie->getNbInscriptionsMax()) {
            /** @var Participant $user */
            $user=$this->getUser();
            $seDesisterSortie->removeParticipant($user);


        }

        $entityManager->persist($seDesisterSortie);
        $entityManager->flush();

        return $this->redirectToRoute( 'app_home');
    }

    /**
     * @Route("/publier/{id}", name="_publier")
     */
    public function publier(int $id, Request $request, EtatRepository $etatRepository, SortieRepository $sortieRepository, EntityManagerInterface $entityManager):Response
    {
        $publierSortie = $sortieRepository->find($id);
        $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);

        $publierSortie->setEtatSortie($etat);


        $entityManager->persist($publierSortie);
        $entityManager->flush();

        return $this->redirectToRoute( 'app_home');
    }
}
