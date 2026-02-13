<?php

namespace App\Entity;

use App\Enum\TypeSport;
use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Entité Sport
 *
 * @property int $id
 * @property string $nom
 * @property TypeSport[] $type
 * @property Collection<Championnats> $championnats
 */
#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: TypeSport::class)]
    private array $type = [];

    #[ORM\OneToMany(mappedBy: 'sport', targetEntity: Championnats::class)]
    private Collection $championnats;

    public function __construct()
    {
        $this->championnats = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    /** @return TypeSport[] */
    public function getType(): array { return $this->type; }
    public function setType(array $type): static { $this->type = $type; return $this; }

    public function getChampionnats(): Collection { return $this->championnats; }
    public function addChampionnat(Championnats $championnat): static
    {
        if (!$this->championnats->contains($championnat)) {
            $this->championnats->add($championnat);
            $championnat->setSport($this);
        }
        return $this;
    }
    public function removeChampionnat(Championnats $championnat): static
    {
        if ($this->championnats->removeElement($championnat)) {
            if ($championnat->getSport() === $this) {
                $championnat->setSport(null);
            }
        }
        return $this;
    }
}
