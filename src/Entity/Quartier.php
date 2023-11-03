<?php

namespace App\Entity;

use App\Repository\QuartierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=QuartierRepository::class)
 */
class Quartier
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Groups({"getUniteQuartier"})
     * 
     */
    private $code_quartier;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getUniteQuartier"})
     */
    private $nom_quartier;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"getUniteQuartier"})
     */
    private $parcelle;

    /**
     * @ORM\ManyToOne(targetEntity=Unite::class, inversedBy="quartiers")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_unite")
     */
    private $unite;

    /**
     * @ORM\OneToMany(targetEntity=Maison::class, mappedBy="quartier")
     * 
     */
    private $maisons;

    /**
     * @ORM\OneToMany(targetEntity=Entreprise::class, mappedBy="quartier")
     */
    private $entreprises;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
    }

   

   

    public function getCodeQuartier(): ?int
    {
        return $this->code_quartier;
    }

    public function setCodeQuartier(int $code_quartier): self
    {
        $this->code_quartier = $code_quartier;

        return $this;
    }

    public function getNomQuartier(): ?string
    {
        return $this->nom_quartier;
    }

    public function setNomQuartier(string $nom_quartier): self
    {
        $this->nom_quartier = $nom_quartier;

        return $this;
    }

    public function getParcelle(): ?string
    {
        return $this->parcelle;
    }

    public function setParcelle(string $parcelle): self
    {
        $this->parcelle = $parcelle;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * @return Collection<int, Maison>
     */
    public function getMaisons(): Collection
    {
        return $this->maisons;
    }

    public function addMaison(Maison $maison): self
    {
        if (!$this->maisons->contains($maison)) {
            $this->maisons[] = $maison;
            $maison->setQuartier($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->removeElement($maison)) {
            // set the owning side to null (unless already changed)
            if ($maison->getQuartier() === $this) {
                $maison->setQuartier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Entreprise>
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->setQuartier($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getQuartier() === $this) {
                $entreprise->setQuartier(null);
            }
        }

        return $this;
    }

    


   
}
