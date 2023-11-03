<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommuneRepository::class)
 */
class Commune
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"getRegionCommune","getCommuneUnite"})
     */
    private $code_commune;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getRegionCommune","getCommuneUnite"})
     */
    private $nom_commune;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="communes")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_region")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Unite::class, mappedBy="commune")
     * @Groups({"getCommuneUnite"})
     */
    private $unites;

    public function __construct()
    {
        $this->unites = new ArrayCollection();
    }


    public function getCodeCommune(): ?int
    {
        return $this->code_commune;
    }

    public function setCodeCommune(int $code_commune): self
    {
        $this->code_commune = $code_commune;

        return $this;
    }

    public function getNomCommune(): ?string
    {
        return $this->nom_commune;
    }

    public function setNomCommune(string $nom_commune): self
    {
        $this->nom_commune = $nom_commune;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Unite>
     */
    public function getUnites(): Collection
    {
        return $this->unites;
    }

    public function addUnite(Unite $unite): self
    {
        if (!$this->unites->contains($unite)) {
            $this->unites[] = $unite;
            $unite->setCommune($this);
        }

        return $this;
    }

    public function removeUnite(Unite $unite): self
    {
        if ($this->unites->removeElement($unite)) {
            // set the owning side to null (unless already changed)
            if ($unite->getCommune() === $this) {
                $unite->setCommune(null);
            }
        }

        return $this;
    }
}
