<?php

namespace App\Exception;

class CameraSystemNotFoundException extends NotFoundException
{
    public static function fromName(string $name): self
    {
        return new self("CameraSystem with name: '$name' not found");
    }
}
