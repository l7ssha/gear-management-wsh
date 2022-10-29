<?php

namespace App\Mapper;

use App\Dto\Gear\CameraSystemLightOutputDto;
use App\Dto\Gear\CameraSystemOutputDto;
use App\Entity\Gear\CameraProducer;
use App\Entity\Gear\CameraSystem;

class CameraSystemDtoMapper
{
    public function __construct(private readonly CameraProducerDtoMapper $cameraProducerDtoMapper)
    {
    }

    public function mapCameraSystemToOutputDto(CameraSystem $cameraSystem): CameraSystemOutputDto
    {
        $dto = new CameraSystemOutputDto();

        $dto->name = $cameraSystem->getName();
        $dto->producers = $cameraSystem->getProducers()
            ->map(fn (CameraProducer $cameraProducer) => $this->cameraProducerDtoMapper->mapCameraProducerToOutputDto($cameraProducer))
            ->toArray()
        ;

        return $dto;
    }

    public function mapCameraSystemToLightOutputDto(CameraSystem $cameraSystem): CameraSystemLightOutputDto
    {
        $dto = new CameraSystemLightOutputDto();

        $dto->name = $cameraSystem->getName();

        return $dto;
    }
}
