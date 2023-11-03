<?php

namespace App\Entity;

use App\Repository\MembreMenageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 

/**
 * @ORM\Entity(repositoryClass=MembreMenageRepository::class)
 */
class MembreMenage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getQuartierMembre"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"getQuartierMembre"})
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"getQuartierMembre"})
     */
    private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="membreMenages")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_personne", onDelete="SET NULL")
     * @Groups({"getQuartierPersonne"})
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity=Menage::class, inversedBy="membreMenages")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_menage", onDelete="SET NULL")
     * @Groups({"getQuartierMenage"})
     */
    private $menage;

    

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): self
    {
        $this->personne = $personne;

        return $this;
    }

    public function getMenage(): ?Menage
    {
        return $this->menage;
    }

    public function setMenage(?Menage $menage): self
    {
        $this->menage = $menage;

        return $this;
    }

}
