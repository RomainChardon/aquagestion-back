<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AquariumRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AquariumRepository::class)]
// #[ApiResource(operations: [
//    new Get(
//        security: "is_granted('ROLE_USER') and object.user == user",
//        securityMessage: "Désolé, vous n'êtes pas le propriétaire de l'aquarium"
//    ),
//    new Put(
//        securityPostDenormalize: "is_granted('ROLE_ADMIN') or (object.user == user and previous_object.user == user)",
//        securityPostDenormalizeMessage: "Désolé, seul le propriétaire de l'aquarium peut le modifier"
//    ),
//    new Post(
//        security: "is_granted('ROLE_ADMIN')",
//        securityMessage: 'Seul les admins peuvent ajouter des aquariums'
//    )
//], security: "is_granted('ROLE_USER')")]
#[ApiResource(security: "is_granted('ROLE_USER')")]
#[Get]
#[Put(security: "is_granted('ROLE_ADMIN') or object.user == user")]
#[Post(security: "is_granted('ROLE_ADMIN')")]
#[GetCollection]
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

    #[ORM\ManyToOne(inversedBy: 'aquarium')]
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
