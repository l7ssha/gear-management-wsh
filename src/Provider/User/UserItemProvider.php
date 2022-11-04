<?php

namespace App\Provider\User;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Auth\User;
use App\Mapper\UserDtoMapper;

class UserItemProvider implements ProviderInterface
{
    public function __construct(
        private readonly ItemProvider $itemProvider,
        private readonly UserDtoMapper $userDtoMapper
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var User|null $object */
        $object = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($object === null) {
            return null;
        }

        return $this->userDtoMapper->mapUserToOutputDto($object);
    }
}
