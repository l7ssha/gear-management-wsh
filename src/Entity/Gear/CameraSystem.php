<?php

namespace App\Entity\Gear;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'camera_systems')]
class CameraSystem
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26)]
    private readonly string $id;

    #[ORM\Column(type: 'string', length: 32)]
    private string $name;

    #[ORM\Column(type: 'string', length: 32)]
    private string $producerName;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
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

    public function getProducerName(): string
    {
        return $this->producerName;
    }

    public function setProducerName(string $producerName): CameraSystem
    {
        $this->producerName = $producerName;

        return $this;
    }
}
