<?php

namespace App\Mapper;

use App\Dto\UserOutputDto;
use App\Entity\Auth\Role;
use App\Entity\Auth\User;

class UserDtoMapper
{
    public function __construct(
        private readonly UserRoleDtoMapper $userRoleMapper
    ) {
    }

    public function mapUserToOutputDto(User $user): UserOutputDto
    {
        $dto = new UserOutputDto();

        $dto->id = $user->getId();
        $dto->username = $user->getUsername();
        $dto->email = $user->getEmail();
        $dto->roles = $user->getRoleObjects()->map(
            fn (Role $role) => $this->userRoleMapper->mapRoleToOutputDto($role)
        )->toArray();

        return $dto;
    }
}
