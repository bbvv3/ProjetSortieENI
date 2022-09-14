<?php

namespace App\Controller;



use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\EtatRepository;
use App\Repository\LieuRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form;
class SortieController extends AbstractController
{
    /**
     * @Route("/sortie", name="app_sortie")
     */
    public function creationSortie(Request $request,
                                   SortieRepository $sortieRepository,
                                   LieuRepository $lieuRepository,
                                   EntityManagerInterface $entityManager,
                                   EtatRepository $etatRepository): Response
    {

        $creerSortie = new Sortie();


        $sortieForm = $this->createForm(SortieType::class, $creerSortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {

            if ($sortieForm->getClickedButton() === $sortieForm->get('publier')){
                $etat = $etatRepository->findOneBy(['libelle' => 'En cours']);


            }
            else{
                $etat = $etatRepository->findOneBy(['libelle' => 'En création']);
            }
            $creerSortie->setEtatSortie($etat);
            $entityManager->persist($creerSortie);
            $entityManager->flush();


        $entityManager->persist($creerSortie);
        $entityManager->flush();
        return $this->redirectToRoute('app_home', ['id' => $creerSortie->getId()]);

    }


        return $this->render('creerSortie/creerSortie.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }
}
