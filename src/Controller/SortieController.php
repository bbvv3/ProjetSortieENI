<?php

namespace App\Controller;



use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SortieController extends AbstractController
{
    /**
     * @Route("/gestionSortie/{id}", name="app_gestionSortie")
     */
    public function creationSortie(int                    $id,
                                   Request                $request,
                                   SortieRepository       $sortieRepository,
                                   EntityManagerInterface $entityManager,
                                   EtatRepository         $etatRepository): Response
    {
        if($id !=0)
        {
            $creerSortie=$sortieRepository->findModifSortie($id);
        }else{
            $creerSortie=new Sortie();
            $creerSortie->setOrganisateur($this->getUser());
            $creerSortie->setSiteOrganisateur($this->getUser()->getCampus());
        }
        $sortieForm = $this->createForm(SortieType::class, $creerSortie);
        if ($id==0)
        {
            $sortieForm->remove('delete');
            $sortieForm->remove('siteOrganisateur');
        }

        $sortieForm->handleRequest($request);
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            if ($sortieForm->getClickedButton() === $sortieForm->get('publier')) {
                $etat = $etatRepository->findOneBy(['libelle' => 'Ouverte']);
                $creerSortie->setEtatSortie($etat);
                $entityManager->persist($creerSortie);
            } else if ($sortieForm->getClickedButton() === $sortieForm->get('enregistrer')) {
                $etat = $etatRepository->findOneBy(['libelle' => 'En création']);
                $creerSortie->setEtatSortie($etat);
                $entityManager->persist($creerSortie);
            } else {
                $sortieForm->getClickedButton() === $sortieForm->get('delete');
                $entityManager->remove($creerSortie);
            }
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('creerSortie/creerSortie.html.twig', [
            'id' => $id,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }


    /**
     * @Route("/AfficherSortie/{id}", name="app_afficher")
     */
    public function afficher(int $id, SortieRepository $sortieRepository):Response
    {
        $sortie = $sortieRepository-> findModifSortie($id);
        return $this->render( 'Afficher/AfficherSortie.html.twig',[
            'sortie' => $sortie
        ]);
    }


    /**
     * @Route("/annuler/{id}", name="app_annuler")
     */
    public function annuler(int $id, Request $request, SortieRepository $sortieRepository, EtatRepository $etatRepository, EntityManagerInterface $entityManager) : Response
    {
        $annulerSortie=$sortieRepository->findModifSortie($id);
        if ($request->getMethod() == "POST") {
            $annulerSortie->setInfosSortie($request->request->get('motif'));
            $etat = $etatRepository->findOneBy(['libelle' => 'Annulée']);
            $annulerSortie->setEtatSortie($etat);
            $entityManager->persist($annulerSortie);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this -> render( 'annuler/annuler.html.twig', [
            'sortie' => $annulerSortie,
        ]);
    }
}