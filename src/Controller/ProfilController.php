<?php

namespace App\Controller;


use App\Form\MonProfilType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
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
                              ParticipantRepository $participantRepository, EntityManagerInterface $entityManager): Response
    {
        // Ici on appel les parametres du user
        $user = $this->getUser();
        $participant = $participantRepository->findOneBy(['mail' => $user->getUserIdentifier()]);
        $monProfilForm = $this->createForm(MonProfilType::class, $participant);
        $monProfilForm->handleRequest($request);
        if ($monProfilForm->isSubmitted() && $monProfilForm->isValid()) {
            // On appel le repository du participant et les tries avec leur mail et on utilise findOneBy pour le retrouver et il sera disponible de partout
            $entityManager->persist($participant);
            $entityManager->flush();
            $this->addFlash('success', 'Profil modifié avec succès!');
            return $this->redirectToRoute('app_home');
        } else if ($monProfilForm->isSubmitted() && !$monProfilForm->isValid()){
            $this->addFlash('error', 'ECHEC de la modification de profil !!!');
        }
        return $this->render('profil/monProfil.html.twig', [
            'monProfilForm' => $monProfilForm->createView(),
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="app_afficherUtilisateur")
     */
    public function afficherUtilisateur(int $id, ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('profil/afficherUtilisateur.html.twig', [
            'participant' => $participant
        ]);
    }

}
