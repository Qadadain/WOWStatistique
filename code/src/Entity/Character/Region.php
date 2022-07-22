<?php

namespace App\Entity\Character;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: false)]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Realm::class, orphanRemoval: true)]
    private Collection $realms;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Character::class, orphanRemoval: true)]
    private Collection $characters;

    public function __construct()
    {
        $this->realms = new ArrayCollection();
        $this->characters = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Realm>
     */
    public function getRealms(): Collection
    {
        return $this->realms;
    }

    public function addRealm(Realm $realm): self
    {
        if (!$this->realms->contains($realm)) {
            $this->realms[] = $realm;
            $realm->setRegion($this);
        }

        return $this;
    }

    public function removeRealm(Realm $realm): self
    {
        if ($this->realms->removeElement($realm)) {
            // set the owning side to null (unless already changed)
            if ($realm->getRegion() === $this) {
                $realm->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setRegion($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getRegion() === $this) {
                $character->setRegion(null);
            }
        }

        return $this;
    }
}
