<?php

namespace App\Entity\Gear;

use App\Model\CameraFormat;
use App\Model\CameraType;
use App\Utils\Doctrine\AbstractAuditableEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'cameras')]
#[ORM\Index(fields: ['model'])]
#[ORM\Index(fields: ['createdBy'])]
class Camera extends AbstractAuditableEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $producerName;

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

    #[ORM\Column(type: 'string')]
    private ?string $serialNumberAlternative = null;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProducerName(): string
    {
        return $this->producerName;
    }

    public function setProducerName(string $producerName): Camera
    {
        $this->producerName = $producerName;

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
