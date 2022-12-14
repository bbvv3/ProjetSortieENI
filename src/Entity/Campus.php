<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 * @UniqueEntity(fields={"nom"}, message="Cet id existe déjà")
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\Length(max=150, maxMessage="Le nom du campus doit contenir 150 caractères maximum")
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Participant::class, mappedBy="campus", orphanRemoval=true)
     */
    private $participantsInscrits;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="siteOrganisateur", orphanRemoval=true)
     */
    private $sorties;

    public function __construct()
    {
        $this->participantsInscrits = new ArrayCollection();
        $this->sorties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Participant>
     */
    public function getParticipantsInscrits(): Collection
    {
        return $this->participantsInscrits;
    }

    public function addParticipantsInscrit(Participant $participantsInscrit): self
    {
        if (!$this->participantsInscrits->contains($participantsInscrit)) {
            $this->participantsInscrits[] = $participantsInscrit;
            $participantsInscrit->setCampus($this);
        }

        return $this;
    }

    public function removeParticipantsInscrit(Participant $participantsInscrit): self
    {
        if ($this->participantsInscrits->removeElement($participantsInscrit)) {
            // set the owning side to null (unless already changed)
            if ($participantsInscrit->getCampus() === $this) {
                $participantsInscrit->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sortie>
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->setSiteOrganisateur($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        $this->sorties->removeElement($sorty);

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
