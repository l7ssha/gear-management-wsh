<?php

namespace App\Exception\NotFound;

use App\Exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public static function fromUserUsernameOrEmail(string $username): self
    {
        return new self("User with username or email: '$username' not found");
    }
}
