<?php

namespace App\DataTransformer;

use App\ApiPlatform\GMWDataTransformer;
use App\Dto\Gear\Camera\CameraOutputDto;
use App\Entity\Gear\Camera;
use App\Mapper\CameraDtoMapper;

class CameraOutputDataTransformer extends GMWDataTransformer
{
    public function __construct(
        private readonly CameraDtoMapper $cameraDtoMapper
    ) {
    }

    /**
     * @param Camera $object
     */
    protected function transform(mixed $object): CameraOutputDto
    {
        return $this->cameraDtoMapper->mapCameraToOutputDto($object);
    }

    protected function supports(mixed $object, ?string $to): bool
    {
        return $object instanceof Camera && CameraOutputDto::class === $to;
    }
}
