<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreerSortieController extends AbstractController
{
    /**
     * @Route("/creer/sortie", name="app_creer_sortie")
     */
    public function index(Request $request,SortieRepository $sortieRepository): Response
    {


        $creerSortie = $sortieRepository->findOneBy(['mail' => $user->getUserIdentifier()]);
        //$monProfilForm =$this->createForm(MonProfilType::class,$participant);
        return $this->render('creerSortie/creerSortie.html.twig', [
            'controller_name' => 'CreerSortieController',
        ]);
    }
}
