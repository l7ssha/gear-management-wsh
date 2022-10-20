<?php

namespace App\Entity\Gear;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class LensFocalLength
{
    #[ORM\Column(type: 'integer')]
    private int $focalLength;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $focalLengthMax = null;
}
