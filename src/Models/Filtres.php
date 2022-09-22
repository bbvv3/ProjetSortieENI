<?php

namespace App\Models;

use App\Entity\Campus;
use App\Entity\Participant;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

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
     * @var null|DateTime
     */
    private $dateDebut;

    /**
     * @var null|DateTime
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
     * @return DateTime|null
     */
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param DateTime|null $dateDebut
     */
    public function setDateDebut(?DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return DateTime|null
     */
    public function getDateFin(): ?DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param DateTime|null $dateFin
     */
    public function setDateFin(?DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }
}
