<?php

namespace App\Entity\Gear;

use App\Utils\Doctrine\AbstractAuditableEntityWithEditorEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'camera_producers')]
#[ORM\Index(fields: ['name'])]
class CameraProducer extends AbstractAuditableEntityWithEditorEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\Column(type: 'string', length: 30)]
    private string $name;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CameraProducer
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
