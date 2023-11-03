<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{

    /**
     * @ORM\Column(type="string", length=100)
     * @ORM\Id
     * @Groups({"getQuartierEntreprise"})
     */
    private $code_entreprise;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getQuartierEntreprise"})
     */
    private $nom_entreprise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"getQuartierEntreprise"})
     */
    private $secteur_activite;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"getQuartierEntreprise"})
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"getQuartierEntreprise"})
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="entreprises")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_personne", onDelete="SET NULL")
     * @Groups({"getQuartierPersonne"})
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity=Quartier::class, inversedBy="entreprises")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_quartier")
     * @Groups({"getUniteQuartier"})
     */
    private $quartier;

   
    public function getCodeEntreprise(): ?string
    {
        return $this->code_entreprise;
    }

    public function setCodeEntreprise(string $code_entreprise): self
    {
        $this->code_entreprise = $code_entreprise;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(string $nom_entreprise): self
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
    }

    public function getSecteurActivite(): ?string
    {
        return $this->secteur_activite;
    }

    public function setSecteurActivite(?string $secteur_activite): self
    {
        $this->secteur_activite = $secteur_activite;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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
