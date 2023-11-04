<?php

namespace App\Entity;

use App\Repository\AuditRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuditRepository::class)
 */
class Audit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_operation;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $propriete;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOperation(): ?string
    {
        return $this->type_operation;
    }

    public function setTypeOperation(string $type_operation): self
    {
        $this->type_operation = $type_operation;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdentite(): ?string
    {
        return $this->identite;
    }

    public function setIdentite(string $identite): self
    {
        $this->identite = $identite;

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

    public function getAgent(): ?string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): self
    {
        $this->agent = $agent;

        return $this;
    }
}
