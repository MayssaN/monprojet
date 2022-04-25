<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetierRepository::class)
 */
class Metier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Travailleur::class, mappedBy="metier")
     */
    private $travailleurs;

    public function __construct()
    {
        $this->travailleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Travailleur>
     */
    public function getTravailleurs(): Collection
    {
        return $this->travailleurs;
    }

    public function addTravailleur(Travailleur $travailleur): self
    {
        if (!$this->travailleurs->contains($travailleur)) {
            $this->travailleurs[] = $travailleur;
            $travailleur->setMetier($this);
        }

        return $this;
    }

    public function removeTravailleur(Travailleur $travailleur): self
    {
        if ($this->travailleurs->removeElement($travailleur)) {
            // set the owning side to null (unless already changed)
            if ($travailleur->getMetier() === $this) {
                $travailleur->setMetier(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->nom;
    }
}
