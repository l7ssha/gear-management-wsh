<?php

namespace App\Utils\Doctrine;

use App\Entity\Auth\User;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAuditTrait
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    protected User $createdBy;

    #[ORM\Column(type: 'datetime_immutable')]
    protected \DateTimeImmutable $createdAt;

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
