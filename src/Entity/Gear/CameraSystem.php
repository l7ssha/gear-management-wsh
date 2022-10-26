<?php

namespace App\Entity\Gear;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Dto\Gear\CameraSystemOutputDto;
use App\Utils\Doctrine\CreatedAuditTrait;
use App\Utils\Doctrine\SoftDeleteTrait;
use App\Utils\Doctrine\UpdatedAuditTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'camera_systems')]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ],
    output: CameraSystemOutputDto::class
)]
class CameraSystem
{
    use SoftDeleteTrait;
    use CreatedAuditTrait;
    use UpdatedAuditTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\Column(type: 'string', length: 32, unique: true)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: CameraProducer::class)]
    private Collection $producers;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->producers = new ArrayCollection();
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

    public function getProducers(): Collection
    {
        return $this->producers;
    }

    public function setProducers(Collection $producers): CameraSystem
    {
        $this->producers = $producers;

        return $this;
    }
}
