<?php

namespace App\Entity\Gear;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class LensFstop
{
    #[ORM\Column(type: 'float')]
    private ?float $minFocalMinFstop = null;

    #[ORM\Column(type: 'float')]
    private ?float $minFocalMaxFstop = null;

    #[ORM\Column(type: 'float')]
    private ?float $maxFocalMinFstop = null;

    #[ORM\Column(type: 'float')]
    private ?float $maxFocalMaxFstop = null;
}
