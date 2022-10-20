<?php

namespace App\Entity\Gear;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'cameras')]
class Camera
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26)]
    private string $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
