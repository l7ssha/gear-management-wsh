<?php

namespace App\Mapper;

use App\Dto\Gear\Camera\CameraOutputDto;
use App\Entity\Gear\Camera;

class CameraDtoMapper
{
    public function __construct(
        private readonly CameraProducerDtoMapper $cameraProducerDtoMapper,
        private readonly CameraSystemDtoMapper $cameraSystemDtoMapper
    ) {
    }

    public function mapCameraToOutputDto(Camera $camera): CameraOutputDto
    {
        $dto = new CameraOutputDto();

        $dto->id = $camera->getId();
        $dto->producer = $this->cameraProducerDtoMapper->mapCameraProducerToOutputDto($camera->getProducer());
        $dto->model = $camera->getModel();
        $dto->type = $camera->getType()->value;
        $dto->format = $camera->getFormat()->value;
        $dto->system = $this->cameraSystemDtoMapper->mapCameraSystemToLightOutputDto($camera->getSystem());
        $dto->serialNumber = $camera->getSerialNumber();
        $dto->serialNumberAlternative = $camera->getSerialNumberAlternative();

        return $dto;
    }
}
