<?php

namespace App\Models;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Repository\SortieRepository;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints\Date;

class Filtres
{
    /**
     * @var Campus
     */
    private $campus;

    /**
     * @var null|string
     */
    private $search;

    /**
     * @var null|date
     */
    private $dateDebut;

    /**
     * @var null|date
     */
    private $dateFin;

    /**
     * @var Boolean
     */
    private $estOrganisateur;

    /**
     * @var Boolean
     */
    private $estInscrit;

    /**
     * @var Boolean
     */
    private $pasInscrit;

    /**
     * @var Boolean
     */
    private $estPasse;

    /**
     * @var Participant
     */
    private $utilisateurActuel;

    /**
     * @return Participant
     */
    public function getUtilisateurActuel(): Participant
    {
        return $this->utilisateurActuel;
    }

    /**
     * @param Participant $utilisateurActuel
     */
    public function setUtilisateurActuel(Participant $utilisateurActuel): void
    {
        $this->utilisateurActuel = $utilisateurActuel;
    }


    /**
     * @return Boolean
     */
    public function getEstOrganisateur(): ?Boolean
    {
        return $this->estOrganisateur;
    }

    /**
     * @param Boolean $estOrganisateur
     */
    public function setEstOrganisateur(?Boolean $estOrganisateur): void
    {
        $this->estOrganisateur = $estOrganisateur;
    }

    /**
     * @return Campus
     */
    public function getCampus(): Campus
    {
        return $this->campus;
    }

    /**
     * @return Boolean
     */
    public function getEstInscrit(): ?Boolean
    {
        return $this->estInscrit;
    }

    /**
     * @param Boolean $estInscrit
     */
    public function setEstInscrit(?Boolean $estInscrit): void
    {
        $this->estInscrit = $estInscrit;
    }

    /**
     * @return Boolean
     */
    public function getPasInscrit(): ?Boolean
    {
        return $this->pasInscrit;
    }

    /**
     * @param Boolean $pasInscrit
     */
    public function setPasInscrit(?Boolean $pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return Boolean
     */
    public function getEstPasse(): ?Boolean
    {
        return $this->estPasse;
    }

    /**
     * @param Boolean $estPasse
     */
    public function setEstPasse(?Boolean $estPasse): void
    {
        $this->estPasse = $estPasse;
    }

    /**
     * @param Campus $campus
     */
    public function setCampus(Campus $campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param string|null $search
     */
    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }

    /**
     * @return Date|null
     */
    public function getDateDebut(): ?Date
    {
        return $this->dateDebut;
    }

    /**
     * @param Date|null $dateDebut
     */
    public function setDateDebut(?Date $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return Date|null
     */
    public function getDateFin(): ?Date
    {
        return $this->dateFin;
    }

    /**
     * @param Date|null $dateFin
     */
    public function setDateFin(?Date $dateFin): void
    {
        $this->dateFin = $dateFin;
    }
}
