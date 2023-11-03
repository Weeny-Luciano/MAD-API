<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MaisonRepository::class)
 */
class Maison
{

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     * @Groups({"getQuartierMaison"})
     */
    private $lot_maison;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"getQuartierMaison"})
     */
    private $nom_maison;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"getQuartierMaison"})
     */
    private $adresse_map;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"getQuartierMaison"})
     */
    private $nb_chambre;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"getQuartierMaison"})
     */
    private $surface;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"getQuartierMaison"})
     */
    private $annee_construction;

    /**
     * @ORM\ManyToOne(targetEntity=TypeMaison::class, inversedBy="maisons")
     * @Groups({"getQuartierTypeMaison"})
     */
    private $type_maison;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="maisons")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_personne" , onDelete="SET NULL")
     * @Groups({"getQuartierPersonne"})
     */
    private $proprietaire;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="maison")
     */
    private $locations;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="maisons")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_quartier")
     * @Groups({"getUniteQuartier"})
     */
    private $quartier;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }

    
    public function getLotMaison(): ?string
    {
        return $this->lot_maison;
    }

    public function setLotMaison(string $lot_maison): self
    {
        $this->lot_maison = $lot_maison;

        return $this;
    }

    public function getNomMaison(): ?string
    {
        return $this->nom_maison;
    }

    public function setNomMaison(?string $nom_maison): self
    {
        $this->nom_maison = $nom_maison;

        return $this;
    }

    public function getAdresseMap(): ?string
    {
        return $this->adresse_map;
    }

    public function setAdresseMap(?string $adresse_map): self
    {
        $this->adresse_map = $adresse_map;

        return $this;
    }

    public function getNbChambre(): ?int
    {
        return $this->nb_chambre;
    }

    public function setNbChambre(int $nb_chambre): self
    {
        $this->nb_chambre = $nb_chambre;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getAnneeConstruction(): ?\DateTimeInterface
    {
        return $this->annee_construction;
    }

    public function setAnneeConstruction(\DateTimeInterface $annee_construction): self
    {
        $this->annee_construction = $annee_construction;

        return $this;
    }

    public function getTypeMaison(): ?TypeMaison
    {
        return $this->type_maison;
    }

    public function setTypeMaison(?TypeMaison $type_maison): self
    {
        $this->type_maison = $type_maison;

        return $this;
    }

    public function getProprietaire(): ?Personne
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Personne $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

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
            $location->setMaison($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getMaison() === $this) {
                $location->setMaison(null);
            }
        }

        return $this;
    }

    public function getQuartier(): ?Quartier
    {
        return $this->quartier;
    }

    public function setQuartier(?Quartier $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }
}
