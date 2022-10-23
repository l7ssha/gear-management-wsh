<?php

namespace App\Mapper;

use App\Dto\CameraSystemOutputDto;
use App\Entity\Gear\CameraProducer;
use App\Entity\Gear\CameraSystem;

class CameraSystemDtoMapper
{
    public function mapCameraSystemToOutputDto(CameraSystem $cameraSystem): CameraSystemOutputDto
    {
        $dto = new CameraSystemOutputDto();

        $dto->name = $cameraSystem->getName();
        $dto->producers = $cameraSystem->getProducers()
            ->map(static fn (CameraProducer $cameraProducer) => $cameraProducer->getName())
            ->toArray()
        ;

        return $dto;
    }
}
