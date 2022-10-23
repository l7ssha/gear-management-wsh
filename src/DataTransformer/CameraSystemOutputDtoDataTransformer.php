<?php

namespace App\DataTransformer;

use App\Dto\CameraSystemOutputDto;
use App\Entity\Gear\CameraSystem;
use App\Mapper\CameraSystemDtoMapper;
use App\Utils\ApiPlatform\GMWDataTransformer;

class CameraSystemOutputDtoDataTransformer extends GMWDataTransformer
{
    public function __construct(
        private readonly CameraSystemDtoMapper $cameraSystemDtoMapper
    ) {
    }

    /**
     * @param CameraSystem $object
     */
    protected function transform(mixed $object): CameraSystemOutputDto
    {
        return $this->cameraSystemDtoMapper->mapCameraSystemToOutputDto($object);
    }

    protected function supports(mixed $object, ?string $to): bool
    {
        return $object instanceof CameraSystem && CameraSystemOutputDto::class === $to;
    }
}
