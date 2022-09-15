<?php

namespace App\Controller;


use App\Form\MonProfilType;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/monProfil", name="app_monProfil")
     */
    public function monProfil(Request $request,
                              ParticipantRepository $participantRepository): Response
    {
        // ici on appel les parametres du user
        $user = $this->getUser();
        // On appel le repository du participant et les tries avec leur mail et on utilise findOneBy pour le retrouver et il sera disponible de partout
        $participant = $participantRepository->findOneBy(['mail' => $user->getUserIdentifier()]);
        $monProfilForm =$this->createForm(MonProfilType::class,$participant);
        //$monProfilForm->handleRequest($request);
        return $this->render('profil/monProfil.html.twig', [
            'monProfilForm' => $monProfilForm->createView(),
        ]);
    }
}
