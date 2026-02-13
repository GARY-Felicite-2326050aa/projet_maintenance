<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entité Epreuve
 *
 * @property int $id
 * @property string $nom
 * @property Competition $competition
 */
#[ORM\Entity]
class Epreuve
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'epreuves'), ORM\JoinColumn(nullable: false)]
    private ?Competition $competition = null;

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getCompetition(): ?Competition { return $this->competition; }
    public function setCompetition(?Competition $competition): static { $this->competition = $competition; return $this; }
}
