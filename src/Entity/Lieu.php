<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(max = 150, maxMessage="Le lieu doit contenir 150 caractères maximum")
     * @Assert\NotBlank(message="Merci de saisir le lieu")
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @Assert\Length(max = 180, maxMessage="La rue doit contenir 180 caractères maximum")
     * @Assert\NotBlank(message="Merci de saisir la rue")
     * @ORM\Column(type="string", length=180)
     */
    private $rue;

    /**
     * @Assert\NotBlank(message="Merci de saisir la latitude")
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @Assert\NotBlank(message="Merci de saisir la longitude")
     * @ORM\Column(type="float")
     */
    private $longitude;

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

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}
