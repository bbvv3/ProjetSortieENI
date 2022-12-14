<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\MainType;
use App\Models\Filtres;
use App\Repository\EtatRepository;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use App\Services\Actualisation;
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
    public function home(Request $request, SortieRepository $sortieRepository, Actualisation $actualisation): Response
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
        $actualisation->miseAJourBDD();

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
    public function inscrire(int $id,
                             EtatRepository $etatRepository,
                             EntityManagerInterface $entityManager,
                             SortieRepository $sortieRepository,
                             Actualisation $actualisation): Response
    {
        $actualisation->miseAJourBDD();
        $inscrireSortie = $sortieRepository->findModifSortie($id);
        if($inscrireSortie){
            $libelle = $inscrireSortie->getEtatSortie()->getLibelle();
            /** @var Participant $user */
            $user=$this->getUser();
            $participants = $inscrireSortie->getParticipants();
            if(($libelle == 'Clôturée' || $libelle == 'Ouverte') && !$participants->contains($user)){
                if (count($inscrireSortie->getParticipants()) == $inscrireSortie->getNbInscriptionsMax() -1) {
                    $inscrireSortie->addParticipant($user);
                    $etat = $etatRepository->findOneBy(['libelle' => 'Clôturée']);
                    $inscrireSortie->setEtatSortie($etat);
                } else if (count($inscrireSortie->getParticipants()) < $inscrireSortie->getNbInscriptionsMax()) {
                    $inscrireSortie->addParticipant($user);
                    $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
                    $inscrireSortie->setEtatSortie($etat);
                }

                $entityManager->persist($inscrireSortie);
                $entityManager->flush();

                $this->addFlash('success', 'Inscription à la sortie : '.$inscrireSortie->getNom().' du '.$inscrireSortie->getDateHeureDebut()->format('d/m/Y').' qui débutera à '.$inscrireSortie->getDateHeureDebut()->format('H:i'));
            }else{
                $this->addFlash('error', 'Inscription impossible à cette sortie');
            }
        }else{
            $this->addFlash('error', 'Cette sortie n\'existe pas');
        }
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/desister/{id}", name="_desister")
     */
    public function seDesister(int $id,
                               SortieRepository $sortieRepository,
                               EtatRepository $etatRepository,
                               EntityManagerInterface $entityManager,
                               Actualisation $actualisation):Response
    {
        $actualisation->miseAJourBDD();
        $seDesisterSortie = $sortieRepository->findModifSortie($id);
        if($seDesisterSortie) {
            $libelle = $seDesisterSortie->getEtatSortie()->getLibelle();
            /** @var Participant $user */
            $user = $this->getUser();
            $participants = $seDesisterSortie->getParticipants();
            if (($libelle == 'Clôturée' || $libelle == 'Ouverte') && $participants->contains($user)) {
                if (count($seDesisterSortie->getParticipants()) == ($seDesisterSortie->getNbInscriptionsMax()) && $seDesisterSortie->getDateLimiteInscription() >= new \DateTime()) {
                    /** @var Participant $user */
                    $user = $this->getUser();
                    $seDesisterSortie->removeParticipant($user);
                    $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
                    $seDesisterSortie->setEtatSortie($etat);

                } else if (count($seDesisterSortie->getParticipants()) <= $seDesisterSortie->getNbInscriptionsMax()) {
                    /** @var Participant $user */
                    $user = $this->getUser();
                    $seDesisterSortie->removeParticipant($user);
                }
                $entityManager->persist($seDesisterSortie);
                $entityManager->flush();
                $this->addFlash('success', 'Désistement à la sortie : ' . $seDesisterSortie->getNom() . ' du ' . $seDesisterSortie->getDateHeureDebut()->format('d/m/Y') . ' qui débutera à ' . $seDesisterSortie->getDateHeureDebut()->format('H:i'));
            }else{
                $this->addFlash('error', 'Vous ne pouvez pas vous désister de cette sortie');
            }
        }else{
            $this->addFlash('error', 'Cette sortie n\'existe pas');
        }
                return $this->redirectToRoute( 'app_home');
    }

    /**
     * @Route("/publier/{id}", name="_publier")
     */
    public function publier(int $id,
                            EtatRepository $etatRepository,
                            SortieRepository $sortieRepository,
                            EntityManagerInterface $entityManager,
                            Actualisation $actualisation):Response
    {
        $actualisation->miseAJourBDD();
        $publierSortie = $sortieRepository->findModifSortie($id);
        if($publierSortie){
            $libelle = $publierSortie->getEtatSortie()->getLibelle();
            /** @var Participant $user */
            $user=$this->getUser();
            if($libelle == 'En création' && $publierSortie->getOrganisateur() == $user){
                $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);

                $publierSortie->setEtatSortie($etat);

                $entityManager->persist($publierSortie);
                $entityManager->flush();
                $this->addFlash('success', 'Publication de la sortie '.$publierSortie->getNom().' réussie!');
            }else{
                $this->addFlash('error', 'Impossible de publier cette sortie');
            }
        }else{
            $this->addFlash('error', 'Cette sortie n\'existe pas');
        }
        return $this->redirectToRoute( 'app_home');
    }
}
