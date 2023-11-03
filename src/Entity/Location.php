<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 


/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 * 
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getQuartierLocation"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"getQuartierLocation"})
     */
    private $date_entre;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"getQuartierLocation"})
     */
    private $date_sortie;

    /**
     * @ORM\ManyToOne(targetEntity=Maison::class, inversedBy="locations")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="lot_maison", onDelete="SET NULL")
     * @Groups({"getQuartierMaison"})
     */
    private $maison;

    /**
     * @ORM\ManyToOne(targetEntity=Menage::class, inversedBy="locations")
     * @ORM\JoinColumn(nullable=true, referencedColumnName="code_menage", onDelete="SET NULL")
     * @Groups({"getQuartierMenage"})
     */
    private $menage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEntre(): ?\DateTimeInterface
    {
        return $this->date_entre;
    }

    public function setDateEntre(\DateTimeInterface $date_entre): self
    {
        $this->date_entre = $date_entre;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): self
    {
        $this->maison = $maison;

        return $this;
    }

    public function getMenage(): ?Menage
    {
        return $this->menage;
    }

    public function setMenage(?Menage $Menage): self
    {
        $this->menage = $Menage;

        return $this;
    }
}
