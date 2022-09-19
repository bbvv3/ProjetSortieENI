<?php

namespace App\Models;

use App\Entity\Campus;
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
     * @var null|Boolean
     */
    private $estOrganisateur;

    /**
     * @var null|Boolean
     */
    private $estInscrit;

    /**
     * @var null|Boolean
     */
    private $pasInscrit;

    /**
     * @var null|Boolean
     */
    private $estPasse;

    /**
     * @return Boolean|null
     */
    public function getEstOrganisateur(): ?Boolean
    {
        return $this->estOrganisateur;
    }

    /**
     * @param Boolean|null $estOrganisateur
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
     * @return Boolean|null
     */
    public function getEstInscrit(): ?Boolean
    {
        return $this->estInscrit;
    }

    /**
     * @param Boolean|null $estInscrit
     */
    public function setEstInscrit(?Boolean $estInscrit): void
    {
        $this->estInscrit = $estInscrit;
    }

    /**
     * @return Boolean|null
     */
    public function getPasInscrit(): ?Boolean
    {
        return $this->pasInscrit;
    }

    /**
     * @param Boolean|null $pasInscrit
     */
    public function setPasInscrit(?Boolean $pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return Boolean|null
     */
    public function getEstPasse(): ?Boolean
    {
        return $this->estPasse;
    }

    /**
     * @param Boolean|null $estPasse
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

    /**
     * @return string[]
     */
    public function getCheckbox(): array
    {
        return $this->checkbox;
    }

    /**
     * @param string[] $checkbox
     */
    public function setCheckbox(array $checkbox): void
    {
        $this->checkbox = $checkbox;
    }

}
