<?php

namespace App\Entity\Gear;

use App\Entity\Auth\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'camera_systems')]
class CameraSystem
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $name;

    #[ORM\Column(type: 'string', length: 32)]
    private string $producerName;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\Column(updatable: false)]
    private User $createdBy;

    #[ORM\Column(type: 'datetime_immutable', updatable: false)]
    private DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $updatedBy = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CameraSystem
    {
        $this->name = $name;

        return $this;
    }

    public function getProducerName(): string
    {
        return $this->producerName;
    }

    public function setProducerName(string $producerName): CameraSystem
    {
        $this->producerName = $producerName;

        return $this;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): CameraSystem
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): CameraSystem
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): CameraSystem
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): CameraSystem
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
