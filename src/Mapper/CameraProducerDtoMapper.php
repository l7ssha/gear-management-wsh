<?php

namespace App\Mapper;

use App\Dto\Gear\CameraProducerOutputDto;
use App\Entity\Gear\CameraProducer;

class CameraProducerDtoMapper
{
    public function mapCameraProducerToOutputDto(CameraProducer $cameraProducer): CameraProducerOutputDto
    {
        $dto = new CameraProducerOutputDto();

        $dto->name = $cameraProducer->getName();

        return $dto;
    }
}
