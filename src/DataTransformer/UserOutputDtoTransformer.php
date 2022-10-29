<?php

namespace App\DataTransformer;

use App\ApiPlatform\GMWDataTransformer;
use App\Dto\UserOutputDto;
use App\Entity\Auth\User;
use App\Mapper\UserDtoMapper;

class UserOutputDtoTransformer extends GMWDataTransformer
{
    public function __construct(
        private readonly UserDtoMapper $userDtoMapper
    ) {
    }

    /**
     * @param User $object
     */
    protected function transform(mixed $object): UserOutputDto
    {
        return $this->userDtoMapper->mapUserToOutputDto($object);
    }

    protected function supports(mixed $object, ?string $to): bool
    {
        return $object instanceof User && UserOutputDto::class === $to;
    }
}
