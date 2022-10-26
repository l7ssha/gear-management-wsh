<?php

namespace App\Dto\Gear\Camera;

use App\Dto\Generic\NameInputDto;
use App\Model\CameraFormat;
use App\Model\CameraType;
use Symfony\Component\Validator\Constraints as Assert;

/** @see CameraCreateInputDtoHandler */
class CameraCreateInputDto
{
    #[Assert\Valid]
    public NameInputDto $producer;

    #[Assert\NotBlank]
    public string $model;

    #[Assert\Valid]
    public CameraType $type;

    #[Assert\Valid]
    public CameraFormat $format;

    #[Assert\Valid]
    public NameInputDto $system;

    #[Assert\NotBlank]
    public string $serialNumber;

    #[Assert\NotBlank(allowNull: true)]
    public ?string $serialNumberAlternative = null;
}
