<?php

namespace App\Dto\Gear;

class CameraSystemOutputDto
{
    public string $name;
    /** @var CameraProducerOutputDto[] */
    public array $producers = [];
}
