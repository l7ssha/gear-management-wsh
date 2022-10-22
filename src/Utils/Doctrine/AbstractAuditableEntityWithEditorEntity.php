<?php

namespace App\Utils\Doctrine;

use App\Entity\Auth\User;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractAuditableEntityWithEditorEntity extends AbstractAuditableEntity
{
    #[ORM\ManyToOne(targetEntity: User::class)]
    protected ?User $updatedBy = null;

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
