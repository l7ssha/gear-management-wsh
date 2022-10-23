<?php

namespace App\Utils\Doctrine;

use App\Entity\Auth\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractAuditableEntity
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    protected User $createdBy;

    #[ORM\Column(type: 'datetime_immutable', updatable: false)]
    protected DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    protected ?DateTimeImmutable $updatedAt = null;

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
