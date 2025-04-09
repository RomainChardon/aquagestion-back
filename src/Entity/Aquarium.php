<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AquariumRepository;
use App\State\AquariumSetUserProcessor;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AquariumRepository::class)]
#[ApiResource(
    operations: [
        new Get(security: "object.user == user or is_granted('ROLE_ADMIN')"),
        new GetCollection(security: "is_granted('ROLE_ADMIN')"),
        new Post(
            denormalizationContext: ['groups' => ['aquarium:create']],
            security: "object.user == user and is_granted('ROLE_USER')",
            validationContext: ['groups' => ['Default', 'aquarium:create']],
            processor: AquariumSetUserProcessor::class),
        new Put(security: "object.user == user or is_granted('ROLE_ADMIN')"),
    ],
    normalizationContext: ['groups' => ['aquarium:read']],
    denormalizationContext: ['groups' => ['aquarium:create', 'aquarium:update']],
)]
class Aquarium
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['aquarium:read'])]
    private ?int $id = null;

    /** Name of aquarium */
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['aquarium:read', 'aquarium:create', 'aquarium:update'])]
    private ?string $name = null;

    /** Aquarium volume */
    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups(['aquarium:read', 'aquarium:create', 'aquarium:update'])]
    private ?int $liter = null;

    #[ORM\ManyToOne(inversedBy: 'aquarium')]
    #[Groups(['aquarium:read'])]
    #[Assert\NotNull]
    private ?User $user = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
