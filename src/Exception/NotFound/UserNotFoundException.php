<?php

namespace App\Exception\NotFound;

use App\Exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public static function fromUserUsername(string $username): self
    {
        return new self("User with username: '$username' not found");
    }
}
