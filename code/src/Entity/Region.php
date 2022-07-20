<?php

namespace App\Entity;

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

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Realm::class)]
    private Collection $realms;

    public function __construct()
    {
        $this->realms = new ArrayCollection();
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
}
