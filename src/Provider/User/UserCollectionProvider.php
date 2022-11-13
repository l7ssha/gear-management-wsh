<?php

namespace App\Provider\User;

use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\Provider\ApiPlatformCollectionProviderTrait;
use App\Entity\Auth\User;
use App\Mapper\UserDtoMapper;

class UserCollectionProvider implements ProviderInterface
{
    use ApiPlatformCollectionProviderTrait;

    public function __construct(
        private readonly CollectionProvider $collectionProvider,
        private readonly UserDtoMapper $userDtoMapper
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Paginator $paginator */
        $paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return $this->getCollectionProvider(
            $paginator,
            fn (User $user) => $this->userDtoMapper->mapUserToOutputDto($user)
        );
    }
}
