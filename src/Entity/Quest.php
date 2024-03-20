<?php

namespace App\Entity;

use App\Repository\QuestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $pnj_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reward = null;

    #[ORM\Column]
    private ?int $act = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPnjName(): ?string
    {
        return $this->pnj_name;
    }

    public function setPnjName(string $pnj_name): static
    {
        $this->pnj_name = $pnj_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getReward(): ?string
    {
        return $this->reward;
    }

    public function setReward(?string $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getAct(): ?int
    {
        return $this->act;
    }

    public function setAct(int $act): static
    {
        $this->act = $act;

        return $this;
    }
}
