<?php

namespace App\Entity\Film;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Model\FilmType;
use App\Utils\Doctrine\CreatedAuditTrait;
use App\Utils\Doctrine\EntityOwnerTrait;
use App\Utils\Doctrine\UpdatedAuditTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'films')]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
#[ORM\Index(fields: ['model'])]
#[ORM\Index(fields: ['createdBy'])]
class Film
{
    use EntityOwnerTrait;
    use CreatedAuditTrait;
    use UpdatedAuditTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\ManyToOne(targetEntity: FilmManufacturer::class)]
    private FilmManufacturer $manufacturer;

    #[ORM\Column(type: 'string', enumType: FilmType::class)]
    private FilmType $filmType;

    #[ORM\Column(type: 'string')]
    private string $model;

    #[ORM\Column(type: 'integer')]
    private int $speed;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getManufacturer(): FilmManufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(FilmManufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }
}
