<?php

namespace App\Entity;

use App\Repository\MenageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MenageRepository::class)
 */
class Menage
{

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getQuartierMenage"})
     */
    private $nom_menage;

    /**
     * @ORM\Column(type="string", length=13)
     * @Groups({"getQuartierMenage"})
     */
    private $tel_menage;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=10)
     * @Groups({"getQuartierMenage"})
     */
    private $code_menage;

    /**
     * @ORM\OneToMany(targetEntity=MembreMenage::class, mappedBy="menage")
     */
    private $membreMenages;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="Menage")
     */
    private $locations;

    public function __construct()
    {
        $this->membreMenages = new ArrayCollection();
        $this->locations = new ArrayCollection();
    }

    

   

    public function getNomMenage(): ?string
    {
        return $this->nom_menage;
    }

    public function setNomMenage(string $nom_menage): self
    {
        $this->nom_menage = $nom_menage;

        return $this;
    }

    public function getTelMenage(): ?string
    {
        return $this->tel_menage;
    }

    public function setTelMenage(string $tel_menage): self
    {
        $this->tel_menage = $tel_menage;

        return $this;
    }

    public function getCodeMenage(): ?string
    {
        return $this->code_menage;
    }

    public function setCodeMenage(string $code_menage): self
    {
        $this->code_menage = $code_menage;

        return $this;
    }

    /**
     * @return Collection<int, MembreMenage>
     */
    public function getMembreMenages(): Collection
    {
        return $this->membreMenages;
    }

    public function addMembreMenage(MembreMenage $membreMenage): self
    {
        if (!$this->membreMenages->contains($membreMenage)) {
            $this->membreMenages[] = $membreMenage;
            $membreMenage->setMenage($this);
        }

        return $this;
    }

    public function removeMembreMenage(MembreMenage $membreMenage): self
    {
        if ($this->membreMenages->removeElement($membreMenage)) {
            // set the owning side to null (unless already changed)
            if ($membreMenage->getMenage() === $this) {
                $membreMenage->setMenage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setMenage($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getMenage() === $this) {
                $location->setMenage(null);
            }
        }

        return $this;
    }

    
}
 