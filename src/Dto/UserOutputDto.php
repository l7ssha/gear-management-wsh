<?php

namespace App\Dto;

class UserOutputDto
{
    public string $id;
    public string $email;
    public string $username;
    /** @var array<UserRoleOutputDto> */
    public array $roles = [];
}
