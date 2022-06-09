<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CopieRepository")
 */
class Copie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $datePret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DateRetour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pretPar;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ouvrage", inversedBy="copies")
     */
    private $ouvrages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function setRef(?int $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getDatePret(): ?string
    {
        return $this->datePret;
    }

    public function setDatePret(?string $datePret): self
    {
        $this->datePret = $datePret;

        return $this;
    }

    public function getDateRetour(): ?string
    {
        return $this->DateRetour;
    }

    public function setDateRetour(?string $DateRetour): self
    {
        $this->DateRetour = $DateRetour;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPretPar(): ?int
    {
        return $this->pretPar;
    }

    public function setPretPar(?int $pretPar): self
    {
        $this->pretPar = $pretPar;

        return $this;
    }

    public function getOuvrages(): ?Ouvrage
    {
        return $this->ouvrages;
    }

    public function setOuvrages(?Ouvrage $ouvrages): self
    {
        $this->ouvrages = $ouvrages;

        return $this;
    }
}
