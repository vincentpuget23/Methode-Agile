<?php

namespace App\Entity;

use App\Repository\HebergeurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HebergeurRepository::class)
 */
class Hebergeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomHotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer")
     */
    private $NombreEtoiles;

    /**
     * @ORM\Column(type="json")
     */
    private $services = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbchambres;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nblits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomHotel(): ?string
    {
        return $this->nomHotel;
    }

    public function setNomHotel(string $nomHotel): self
    {
        $this->nomHotel = $nomHotel;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getNombreEtoiles(): ?int
    {
        return $this->NombreEtoiles;
    }

    public function setNombreEtoiles(int $NombreEtoiles): self
    {
        $this->NombreEtoiles = $NombreEtoiles;

        return $this;
    }

    /**
     * @see HebergeurInterface
     */
    public function getServices(): array
    {
        $services = $this->services;
    
        return array_unique($services);
    }

    public function setServices(array $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getNbchambres(): ?int
    {
        return $this->nbchambres;
    }

    public function setNbchambres(?int $nbchambres): self
    {
        $this->nbchambres = $nbchambres;

        return $this;
    }

    public function getNblits(): ?int
    {
        return $this->nblits;
    }

    public function setNblits(?int $nblits): self
    {
        $this->nblits = $nblits;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
