<?php

namespace App\Exception\NotFound;

use App\Exception\NotFoundException;

class CameraSystemNotFoundException extends NotFoundException
{
    public static function fromName(string $name): self
    {
        return new self("CameraSystem with name: '$name' not found");
    }
}
