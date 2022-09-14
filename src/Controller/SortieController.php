<?php

namespace App\Controller;


use App\Entity\Etat;
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
        $etat = $etatRepository->find(['id'=>4]);
        $creerSortie = new Sortie();

        $creerSortie->setEtatSortie($etat);
        $sortieForm =$this->createForm(SortieType::class,$creerSortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $creerSortie->setIsPublished(true);

            $entityManager->persist($creerSortie);
            $entityManager->flush();

            return $this->redirectToRoute('app_home',['id'=>$creerSortie->getId()]);

        }


        return $this->render('creerSortie/creerSortie.html.twig', [
            'sortieForm' => $sortieForm->createView(),
        ]);
    }
}
