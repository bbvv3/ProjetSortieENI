<?php

namespace App\Models;

use App\Entity\Campus;
use App\Entity\Participant;
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
     * @var bool
     */
    private $estOrganisateur;

    /**
     * @var bool
     */
    private $estInscrit;

    /**
     * @var bool
     */
    private $pasInscrit;

    /**
     * @var bool
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
     * @return bool
     */
    public function getEstOrganisateur(): ?bool
    {
        return $this->estOrganisateur;
    }

    /**
     * @param bool $estOrganisateur
     */
    public function setEstOrganisateur(?bool $estOrganisateur): void
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
     * @return bool
     */
    public function getEstInscrit(): ?bool
    {
        return $this->estInscrit;
    }

    /**
     * @param bool $estInscrit
     */
    public function setEstInscrit(?bool $estInscrit): void
    {
        $this->estInscrit = $estInscrit;
    }

    /**
     * @return bool
     */
    public function getPasInscrit(): ?bool
    {
        return $this->pasInscrit;
    }

    /**
     * @param bool $pasInscrit
     */
    public function setPasInscrit(?bool $pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return bool
     */
    public function getEstPasse(): ?bool
    {
        return $this->estPasse;
    }

    /**
     * @param bool $estPasse
     */
    public function setEstPasse(?bool $estPasse): void
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
