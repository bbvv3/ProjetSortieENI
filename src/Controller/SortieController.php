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
        // ici on recupere si le formulaire est deja rempli
        if($id !=0)
        {
            $creerSortie=$sortieRepository->findModifSortie();
        }else{
            // si non ici on creer un nouveau formulaire
            $creerSortie=new Sortie();

        }
        $sortieForm = $this->createForm(SortieType::class, $creerSortie);
        // ici on verifie pour que le boutton apparaisse ou pas
        // en fonction de l'environement ou on se trouve
        if ($id==0)
        {
            $sortieForm->remove('delete');
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
        $sortie = $sortieRepository-> find($id);
        return $this->render( 'Afficher/AfficherSortie.html.twig',[
            'sortie' => $sortie
        ]);
    }

}



