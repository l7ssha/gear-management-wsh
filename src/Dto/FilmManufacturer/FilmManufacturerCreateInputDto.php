<?php

namespace App\Dto\FilmManufacturer;

use Symfony\Component\Validator\Constraints as Assert;

/** @see FilmManufacturerCreateInputDtoHandler */
class FilmManufacturerCreateInputDto
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    public string $name;
}
