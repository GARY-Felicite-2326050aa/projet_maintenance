<?php

namespace App\Entity;

use App\Repository\ChampionnatsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Entité Championnats
 *
 * @property int $id
 * @property string $nom
 * @property Sport $sport
 * @property Collection<Competition> $competitions
 */
#[ORM\Entity(repositoryClass: ChampionnatsRepository::class)]
class Championnats
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'championnats'), ORM\JoinColumn(nullable: false)]
    private ?Sport $sport = null;

    #[ORM\OneToMany(mappedBy: 'championnat', targetEntity: Competition::class)]
    private Collection $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getSport(): ?Sport { return $this->sport; }
    public function setSport(?Sport $sport): static { $this->sport = $sport; return $this; }

    public function getCompetitions(): Collection { return $this->competitions; }
    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setChampionnat($this);
        }
        return $this;
    }
    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            if ($competition->getChampionnat() === $this) {
                $competition->setChampionnat(null);
            }
        }
        return $this;
    }
}
