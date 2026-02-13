<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entité Competition
 *
 * @property int $id
 * @property string $nom
 * @property Championnats $championnat
 * @property Collection<Epreuve> $epreuves
 */
#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'competitions'), ORM\JoinColumn(nullable: false)]
    private ?Championnats $championnat = null;

    #[ORM\OneToMany(mappedBy: 'competition', targetEntity: Epreuve::class)]
    private Collection $epreuves;

    public function __construct()
    {
        $this->epreuves = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getChampionnat(): ?Championnats { return $this->championnat; }
    public function setChampionnat(?Championnats $championnat): static { $this->championnat = $championnat; return $this; }

    public function getEpreuves(): Collection { return $this->epreuves; }
    public function addEpreuve(Epreuve $epreuve): static
    {
        if (!$this->epreuves->contains($epreuve)) {
            $this->epreuves->add($epreuve);
            $epreuve->setCompetition($this);
        }
        return $this;
    }
    public function removeEpreuve(Epreuve $epreuve): static
    {
        if ($this->epreuves->removeElement($epreuve)) {
            if ($epreuve->getCompetition() === $this) {
                $epreuve->setCompetition(null);
            }
        }
        return $this;
    }
}
