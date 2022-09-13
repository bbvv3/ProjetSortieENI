<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\MonProfilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/monProfil", name="app_monProfil")
     */
    public function monProfil(Request $request): Response
    {
        $participant = new Participant();
        $monProfilForm =$this->createForm(MonProfilType::class,$participant);
        //$monProfilForm->handleRequest($request);
        return $this->render('profil/monProfil.html.twig', [
            'monProfilForm' => $monProfilForm->createView(),
        ]);
    }
}
