<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getAgent"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getAgent"})
     */
    private $nom_agent;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getAgent"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"getAgent"})
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"getAgent"})
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getAgent"})
     */
    private $propriete;

    /**
     * @ORM\OneToOne(targetEntity=Quartier::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_quartier")
     * @Groups({"getAgent"})
     */
    private $quartier;

    /**
     * @ORM\OneToOne(targetEntity=Unite::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_unite")
     * @Groups({"getAgent"})
     */
    private $unite;

    /**
     * @ORM\OneToOne(targetEntity=Commune::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_commune")
     * @Groups({"getAgent"})
     */
    private $commune;

    /**
     * @ORM\OneToOne(targetEntity=Region::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_region")
     * @Groups({"getAgent"})
     */
    private $Region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgent(): ?string
    {
        return $this->nom_agent;
    }

    public function setNomAgent(string $nom_agent): self
    {
        $this->nom_agent = $nom_agent;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
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

    public function getPropriete(): ?string
    {
        return $this->propriete;
    }

    public function setPropriete(string $propriete): self
    {
        $this->propriete = $propriete;

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

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): self
    {
        $this->unite = $unite;

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

    public function getRegion(): ?Region
    {
        return $this->Region;
    }

    public function setRegion(?Region $Region): self
    {
        $this->Region = $Region;

        return $this;
    }
}
