<?php

namespace App\Entity\Gear;

use App\Model\LensType;
use App\Utils\Doctrine\AbstractAuditableEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'lenses')]
#[ORM\Index(fields: ['model'])]
class Lens extends AbstractAuditableEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26, updatable: false)]
    private readonly string $id;

    #[ORM\ManyToOne(targetEntity: CameraProducer::class)]
    private CameraProducer $producerName;

    #[ORM\Column(type: 'string', length: 32)]
    private string $model;

    #[ORM\Column(type: 'string', enumType: LensType::class)]
    private LensType $type;

    #[ORM\ManyToOne(targetEntity: CameraSystem::class)]
    private CameraSystem $system;

    #[ORM\Embedded(class: LensFocalLength::class)]
    private LensFocalLength $focalLength;

    #[ORM\Embedded(class: LensFstop::class)]
    private LensFstop $fstop;

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

    public function getProducerName(): CameraProducer
    {
        return $this->producerName;
    }

    public function setProducerName(CameraProducer $producerName): Lens
    {
        $this->producerName = $producerName;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): Lens
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): LensType
    {
        return $this->type;
    }

    public function setType(LensType $type): Lens
    {
        $this->type = $type;

        return $this;
    }

    public function getSystem(): CameraSystem
    {
        return $this->system;
    }

    public function setSystem(CameraSystem $system): Lens
    {
        $this->system = $system;

        return $this;
    }

    public function getFocalLength(): LensFocalLength
    {
        return $this->focalLength;
    }

    public function setFocalLength(LensFocalLength $focalLength): Lens
    {
        $this->focalLength = $focalLength;

        return $this;
    }

    public function getFstop(): LensFstop
    {
        return $this->fstop;
    }

    public function setFstop(LensFstop $fstop): Lens
    {
        $this->fstop = $fstop;

        return $this;
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): Lens
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getSerialNumberAlternative(): ?string
    {
        return $this->serialNumberAlternative;
    }

    public function setSerialNumberAlternative(?string $serialNumberAlternative): Lens
    {
        $this->serialNumberAlternative = $serialNumberAlternative;

        return $this;
    }
}
