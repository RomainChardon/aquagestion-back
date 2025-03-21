<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AquariumRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AquariumRepository::class)]
#[ApiResource]
class Aquarium
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** Name of aquarium */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    /** Aquarium volume */
    #[ORM\Column]
    #[Assert\NotNull]
    private ?int $liter = null;

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

    public function getLiter(): ?int
    {
        return $this->liter;
    }

    public function setLiter(int $liter): static
    {
        $this->liter = $liter;

        return $this;
    }
}
