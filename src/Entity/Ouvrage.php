<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OuvrageRepository")
 */
class Ouvrage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $anneeProd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dislikes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCopies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Copie", mappedBy="ouvrage", cascade={"persist"})
     */
    private $copies;

    public function __construct()
    {
        $this->copies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getAnneeProd(): ?string
    {
        return $this->anneeProd;
    }

    public function setAnneeProd(?string $anneeProd): self
    {
        $this->anneeProd = $anneeProd;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(?string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDislikes(): ?int
    {
        return $this->dislikes;
    }

    public function setDislikes(?int $dislikes): self
    {
        $this->dislikes = $dislikes;

        return $this;
    }

    public function getNbCopies(): ?int
    {
        return $this->nbCopies;
    }

    public function setNbCopies(?int $nbCopies): self
    {
        $this->nbCopies = $nbCopies;

        return $this;
    }

    /**
     * @return Collection|Copie[]
     */
    public function getCopies(): Collection
    {
        return $this->copies;
    }

    public function addCopy(Copie $copy): self
    {
        if (!$this->copies->contains($copy)) {
            $this->copies[] = $copy;
            $copy->setOuvrages($this);
        }

        return $this;
    }

    public function removeCopy(Copie $copy): self
    {
        if ($this->copies->contains($copy)) {
            $this->copies->removeElement($copy);
            // set the owning side to null (unless already changed)
            if ($copy->getOuvrages() === $this) {
                $copy->setOuvrages(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->getTitre();
 }
}
