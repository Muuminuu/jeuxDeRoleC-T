<?php

namespace App\Entity;

use App\Repository\WeaponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaponRepository::class)]
class Weapon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?bool $acquired = null;

    #[ORM\Column]
    private ?int $damage = null;

    #[ORM\Column(length: 30)]
    private ?string $damage_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function isAcquired(): ?bool
    {
        return $this->acquired;
    }

    public function setAcquired(bool $acquired): static
    {
        $this->acquired = $acquired;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): static
    {
        $this->damage = $damage;

        return $this;
    }

    public function getDamageType(): ?string
    {
        return $this->damage_type;
    }

    public function setDamageType(string $damage_type): static
    {
        $this->damage_type = $damage_type;

        return $this;
    }
}
