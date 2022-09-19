<?php

namespace App\Models;

use App\Entity\Campus;
use App\Repository\SortieRepository;
use Symfony\Component\Validator\Constraints\Date;

class RechercherSortie
{

    /**
     * @param Campus $campus
     */public function __construct(Campus $campus)
        {
            $this->campus = $campus;
        }


    /**
     * @var Campus
     */
    private $campus;

    /**
     * @var null|string
     */
    private $search = '';

    /**
     * @var null|date
     */
    private $dateDebut;

    /**
     * @var null|date
     */
    private $dateFin;

    /**
     * @var string[]
     */
    private $checkbox = [];


    /**
     * @return Campus
     */
    public function getCampus(): Campus
    {
        return $this->campus;
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
