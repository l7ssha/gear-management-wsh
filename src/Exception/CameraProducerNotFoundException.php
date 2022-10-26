<?php

namespace App\Exception;

class CameraProducerNotFoundException extends NotFoundException
{
    public static function fromName(string $name): self
    {
        return new self("CameraProducer with name: '$name' not found");
    }
}
