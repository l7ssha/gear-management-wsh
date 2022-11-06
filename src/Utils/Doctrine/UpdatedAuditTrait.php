<?php

namespace App\Utils\Doctrine;

use App\Entity\Auth\User;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAuditTrait
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    protected ?User $updatedBy = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    protected ?DateTimeImmutable $updatedAt = null;

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

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
