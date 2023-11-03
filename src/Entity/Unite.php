<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UniteRepository::class)
 */
class Unite
{
   
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"getCommuneUnite", "getUniteQuartier"})
     */
    private $code_unite;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getCommuneUnite", "getUniteQuartier"})
     */
    private $nom_unite;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="unites")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_commune")
     * 
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity=Quartier::class, mappedBy="unite")
     * @Groups({"getUniteQuartier"})
     */
    private $quartiers;

    public function __construct()
    {
        $this->quartiers = new ArrayCollection();
    }

    public function getCodeUnite(): ?int
    {
        return $this->code_unite;
    }

    public function setCodeUnite(int $code_unite): self
    {
        $this->code_unite = $code_unite;

        return $this;
    }

    public function getNomUnite(): ?string
    {
        return $this->nom_unite;
    }

    public function setNomUnite(string $nom_unite): self
    {
        $this->nom_unite = $nom_unite;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection<int, Quartier>
     */
    public function getQuartiers(): Collection
    {
        return $this->quartiers;
    }

    public function addQuartier(Quartier $quartier): self
    {
        if (!$this->quartiers->contains($quartier)) {
            $this->quartiers[] = $quartier;
            $quartier->setUnite($this);
        }

        return $this;
    }

    public function removeQuartier(Quartier $quartier): self
    {
        if ($this->quartiers->removeElement($quartier)) {
            // set the owning side to null (unless already changed)
            if ($quartier->getUnite() === $this) {
                $quartier->setUnite(null);
            }
        }

        return $this;
    }
}
