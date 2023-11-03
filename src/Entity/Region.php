<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"getRegionCommune"})
     */
    private $code_region;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getRegionCommune"})
     */
    private $nom_region;

    /**
     * @ORM\OneToMany(targetEntity=Commune::class, mappedBy="region")
     * @Groups({"getRegionCommune"})
     */
    private $communes;

    public function __construct()
    {
        $this->communes = new ArrayCollection();
    }

    
    public function getCodeRegion(): ?int
    {
        return $this->code_region;
    }

    public function setCodeRegion(int $code_region): self
    {
        $this->code_region = $code_region;

        return $this;
    }

    public function getNomRegion(): ?string
    {
        return $this->nom_region;
    }

    public function setNomRegion(string $nom_region): self
    {
        $this->nom_region = $nom_region;

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

    public function addCommune(Commune $commune): self
    {
        if (!$this->communes->contains($commune)) {
            $this->communes[] = $commune;
            $commune->setRegion($this);
        }

        return $this;
    }

    public function removeCommune(Commune $commune): self
    {
        if ($this->communes->removeElement($commune)) {
            // set the owning side to null (unless already changed)
            if ($commune->getRegion() === $this) {
                $commune->setRegion(null);
            }
        }

        return $this;
    }
}
