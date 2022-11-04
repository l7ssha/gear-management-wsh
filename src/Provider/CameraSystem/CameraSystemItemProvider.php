<?php

namespace App\Provider\CameraSystem;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface as ProviderInterfaceAlias;
use App\Entity\Gear\CameraSystem;
use App\Mapper\CameraSystemDtoMapper;

class CameraSystemItemProvider implements ProviderInterfaceAlias
{
    public function __construct(
        private readonly ItemProvider $itemProvider,
        private readonly CameraSystemDtoMapper $cameraSystemDtoMapper
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var CameraSystem|null $object */
        $object = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($object === null) {
            return null;
        }

        return $this->cameraSystemDtoMapper->mapCameraSystemToOutputDto($object);
    }
}
