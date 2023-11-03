<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 * 
 */
class Personne
{

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getQuartierPersonne"})
     */
    private $nom_personne;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"getQuartierPersonne"})
     */
    private $prenom_personne;

    /**
     * @ORM\Column(type="date")
     * @Groups({"getQuartierPersonne"})
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"getQuartierPersonne"})
     */
    private $sexe;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     * @Groups({"getQuartierPersonne"})
     */
    private $code_personne;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="personnes")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_personne", onDelete="SET NULL")
     * @Groups({"getQuartierPersonne"})
     */
    private $pere_personne;
    /**
     * @ORM\OneToMany(targetEntity=Personne::class, mappedBy="pere_personne", mappedBy="mere_personne")
     * 
     * 
     */
    private $personnes;
    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="personnes")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_personne", onDelete="SET NULL")
     * @Groups({"getQuartierPersonne"})
     */
    private $mere_personne;

    /**
     * @ORM\OneToMany(targetEntity=MembreMenage::class, mappedBy="personne")
     */
    private $membreMenages;

    /**
     * @ORM\OneToMany(targetEntity=Maison::class, mappedBy="proprietaire")
     */
    private $maisons;

    /**
     * @ORM\OneToMany(targetEntity=Entreprise::class, mappedBy="proprietaire")
     */
    private $entreprises;

    
    

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
        $this->membreMenages = new ArrayCollection();
        $this->maisons = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
    }


    public function getNomPersonne(): ?string
    {
        return $this->nom_personne;
    }

    public function setNomPersonne(string $nom_personne): self
    {
        $this->nom_personne = $nom_personne;

        return $this;
    }

    public function getPrenomPersonne(): ?string
    {
        return $this->prenom_personne;
    }

    public function setPrenomPersonne(?string $prenom_personne): self
    {
        $this->prenom_personne = $prenom_personne;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getCodePersonne(): ?string
    {
        return $this->code_personne;
    }

    public function setCodePersonne(string $code_personne): self
    {
        $this->code_personne = $code_personne;

        return $this;
    }

    public function getPerePersonne(): ?self
    {
        return $this->pere_personne;
    }

    public function setPerePersonne(?self $pere_personne): self
    {
        $this->pere_personne = $pere_personne;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(self $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->setPerePersonne($this);
        }

        return $this;
    }

    public function removePersonne(self $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            // set the owning side to null (unless already changed)
            if ($personne->getPerePersonne() === $this) {
                $personne->setPerePersonne(null);
            }
        }

        return $this;
    }

    public function getMerePersonne(): ?self
    {
        return $this->mere_personne;
    }

    public function setMerePersonne(?self $mere_personne): self
    {
        $this->mere_personne = $mere_personne;

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
            $membreMenage->setPersonne($this);
        }

        return $this;
    }

    public function removeMembreMenage(MembreMenage $membreMenage): self
    {
        if ($this->membreMenages->removeElement($membreMenage)) {
            // set the owning side to null (unless already changed)
            if ($membreMenage->getPersonne() === $this) {
                $membreMenage->setPersonne(null);
            }
        }

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
            $maison->setProprietaire($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->removeElement($maison)) {
            // set the owning side to null (unless already changed)
            if ($maison->getProprietaire() === $this) {
                $maison->setProprietaire(null);
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
            $entreprise->setProprietaire($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            // set the owning side to null (unless already changed)
            if ($entreprise->getProprietaire() === $this) {
                $entreprise->setProprietaire(null);
            }
        }

        return $this;
    }

    
}
