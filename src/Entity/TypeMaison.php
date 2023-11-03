<?php

namespace App\Entity;

use App\Repository\TypeMaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups; 

/**
 * @ORM\Entity(repositoryClass=TypeMaisonRepository::class)
 */
class TypeMaison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"getQuartierTypeMaison"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"getQuartierTypeMaison"})
     */
    private $nom_type;

    /**
     * @ORM\OneToMany(targetEntity=Maison::class, mappedBy="type_maison")
     * 
     */
    private $maisons;

    public function __construct()
    {
        $this->maisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomType(): ?string
    {
        return $this->nom_type;
    }

    public function setNomType(string $nom_type): self
    {
        $this->nom_type = $nom_type;

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
            $maison->setTypeMaison($this);
        }

        return $this;
    }

    public function removeMaison(Maison $maison): self
    {
        if ($this->maisons->removeElement($maison)) {
            // set the owning side to null (unless already changed)
            if ($maison->getTypeMaison() === $this) {
                $maison->setTypeMaison(null);
            }
        }

        return $this;
    }
}
