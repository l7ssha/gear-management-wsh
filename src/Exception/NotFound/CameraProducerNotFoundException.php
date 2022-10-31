<?php

namespace App\Exception\NotFound;

use App\Exception\NotFoundException;

class CameraProducerNotFoundException extends NotFoundException
{
    public static function fromName(string $name): self
    {
        return new self("CameraProducer with name: '$name' not found");
    }
}
