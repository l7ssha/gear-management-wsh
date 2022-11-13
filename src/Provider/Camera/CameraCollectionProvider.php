<?php

namespace App\Provider\Camera;

use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\Provider\ApiPlatformCollectionProviderTrait;
use App\Entity\Gear\Camera;
use App\Mapper\CameraDtoMapper;

class CameraCollectionProvider implements ProviderInterface
{
    use ApiPlatformCollectionProviderTrait;

    public function __construct(
        private readonly CollectionProvider $collectionProvider,
        private readonly CameraDtoMapper $cameraDtoMapper
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Paginator $paginator */
        $paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return $this->getCollectionProvider(
            $paginator,
            fn (Camera $user) => $this->cameraDtoMapper->mapCameraToOutputDto($user)
        );
    }
}
