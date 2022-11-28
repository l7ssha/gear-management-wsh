<?php

namespace App\Mapper;

use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;
use App\Entity\Film\FilmManufacturer;

class FilmManufacturerDtoMapper
{
    public function mapFilmManufacturerToOutputDto(FilmManufacturer $entity): FilmManufacturerOutputDto
    {
        $dto = new FilmManufacturerOutputDto();

        $dto->id = $entity->getId();
        $dto->name = $entity->getName();

        return $dto;
    }
}
