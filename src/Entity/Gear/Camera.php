<?php

namespace App\Entity\Gear;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Dto\Gear\Camera\CameraCreateInputDto;
use App\Dto\Gear\Camera\CameraOutputDto;
use App\Model\CameraFormat;
use App\Model\CameraType;
use App\Provider\Camera\CameraCollectionProvider;
use App\Provider\Camera\CameraItemProvider;
use App\Utils\Doctrine\CreatedAuditTrait;
use App\Utils\Doctrine\EntityOwnerTrait;
use App\Utils\Doctrine\UpdatedAuditTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'cameras')]
#[ORM\Index(fields: ['model'])]
#[ORM\Index(fields: ['createdBy'])]
#[ApiResource(
    operations: [
        new GetCollection(provider: CameraCollectionProvider::class),
        new Get(provider: CameraItemProvider::class),
        new Post(input: CameraCreateInputDto::class, messenger: 'input'),
        new Delete(status: 200, messenger: 'input'),
    ],
    output: CameraOutputDto::class
)]
#[UniqueEntity(['serialNumber', 'createdBy'], message: 'Camera with same serial number already exists')]
class Camera
{
    use EntityOwnerTrait;
    use CreatedAuditTrait;
    use UpdatedAuditTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\ManyToOne(targetEntity: CameraProducer::class)]
    private CameraProducer $producer;

    #[ORM\Column(type: 'string', length: 32)]
    private string $model;

    #[ORM\Column(type: 'string', enumType: CameraType::class)]
    private CameraType $type;

    #[ORM\Column(type: 'string', enumType: CameraFormat::class)]
    private CameraFormat $format;

    #[ORM\ManyToOne(targetEntity: CameraSystem::class)]
    private CameraSystem $system;

    #[ORM\Column(type: 'string')]
    private string $serialNumber;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $serialNumberAlternative = null;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProducer(): CameraProducer
    {
        return $this->producer;
    }

    public function setProducer(CameraProducer $producer): Camera
    {
        $this->producer = $producer;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): Camera
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): CameraType
    {
        return $this->type;
    }

    public function setType(CameraType $type): Camera
    {
        $this->type = $type;

        return $this;
    }

    public function getFormat(): CameraFormat
    {
        return $this->format;
    }

    public function setFormat(CameraFormat $format): Camera
    {
        $this->format = $format;

        return $this;
    }

    public function getSystem(): CameraSystem
    {
        return $this->system;
    }

    public function setSystem(CameraSystem $system): Camera
    {
        $this->system = $system;

        return $this;
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): Camera
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getSerialNumberAlternative(): ?string
    {
        return $this->serialNumberAlternative;
    }

    public function setSerialNumberAlternative(?string $serialNumberAlternative): Camera
    {
        $this->serialNumberAlternative = $serialNumberAlternative;

        return $this;
    }
}
