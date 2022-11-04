<?php

namespace App\Provider\Camera;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface as ProviderInterfaceAlias;
use App\Entity\Gear\Camera;
use App\Mapper\CameraDtoMapper;

class CameraItemProvider implements ProviderInterfaceAlias
{
    public function __construct(
        private readonly ItemProvider $itemProvider,
        private readonly CameraDtoMapper $cameraDtoMapper
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Camera|null $object */
        $object = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($object === null) {
            return null;
        }

        return $this->cameraDtoMapper->mapCameraToOutputDto($object);
    }
}
