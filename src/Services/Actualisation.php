<?php

namespace App\Services;

use App\Entity\Sortie;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;

class Actualisation
{
    private SortieRepository $sortieRepository;
    private EtatRepository $etatRepository;
    private EntityManagerInterface $entityManager;

    public function __construct($sortieRepository, $etatRepository, $entityManager)
    {
        $this->sortieRepository = $sortieRepository;
        $this->etatRepository = $etatRepository;
        $this->entityManager = $entityManager;
    }

    private function modifEtat($sorties,string $libelle){
        if(!empty($sorties)){
            $etat=$this->etatRepository->findOneBy(['libelle'=> $libelle]);
            foreach ($sorties as $sortie){
                $sortie->setEtatSortie($etat);
            }
            $this->entityManager->persist($sorties);
            $this->entityManager->flush();
        }
    }

    public function miseAJourBDD(){
        $sorties = $this->sortieRepository->findOuvertToCloture();
        $this->modifEtat($sorties,'Cloturée');
        $sorties = $this->sortieRepository->findClotureToEnCours();
        $this->modifEtat($sorties,'Ouverte');
        $sorties = $this->sortieRepository->findEnCoursToTermine();
        $this->modifEtat($sorties, 'Terminée');
        $sorties = $this->sortieRepository->findTermineAndAnnulerToHistorise();
        $this->modifEtat($sorties, 'Historisée');
    }
}