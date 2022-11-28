<?php

namespace App\Entity\Film;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Dto\FilmManufacturer\FilmManufacturerCreateInputDto;
use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;
use App\Dto\FilmManufacturer\FilmManufacturerUpdateInputDto;
use App\Provider\FilmManufacturer\FilmManufacturerCollectionProvider;
use App\Provider\FilmManufacturer\FilmManufacturerItemProvider;
use App\Utils\Doctrine\CreatedAuditTrait;
use App\Utils\Doctrine\UpdatedAuditTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'film_manufacturers')]
#[ApiResource(
    operations: [
        new Get(
            provider: FilmManufacturerItemProvider::class
        ),
        new GetCollection(
            provider: FilmManufacturerCollectionProvider::class
        ),
        new Post(
            security: "is_granted('ROLE_MANAGE_FILM_MANUFACTURER')",
            input: FilmManufacturerCreateInputDto::class,
            messenger: 'input'
        ),
        new Patch(
            security: "is_granted('ROLE_MANAGE_FILM_MANUFACTURER')",
            input: FilmManufacturerUpdateInputDto::class,
            messenger: 'input'
        ),
        new Delete(
            status: 204,
            security: "is_granted('ROLE_MANAGE_FILM_MANUFACTURER')",
            output: false,
            messenger: 'input'
        ),
    ],
    output: FilmManufacturerOutputDto::class
)]
#[ORM\Index(fields: ['name'])]
#[UniqueEntity(fields: ['name'])]
class FilmManufacturer
{
    use CreatedAuditTrait;
    use UpdatedAuditTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $name;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
