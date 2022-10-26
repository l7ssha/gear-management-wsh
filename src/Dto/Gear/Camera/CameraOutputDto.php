<?php

namespace App\Dto\Gear\Camera;

use App\Dto\Gear\CameraProducerOutputDto;
use App\Dto\Gear\CameraSystemOutputDto;

class CameraOutputDto
{
    public string $id;
    public CameraProducerOutputDto $producer;
    public string $model;
    public string $type;
    public string $format;
    public CameraSystemOutputDto $system;
    public string $serialNumber;
    public ?string $serialNumberAlternative = null;
}
