<?php

namespace App\Mapper;

use App\Dto\Film\FilmOutputDto;
use App\Entity\Film\Film;

class FilmDtoMapper
{
    public function __construct(
        private readonly FilmManufacturerDtoMapper $filmManufacturerDtoMapper
    ) {
    }

    public function mapFilmToOutputDto(Film $film): FilmOutputDto
    {
        $dto = new FilmOutputDto();

        $dto->id = $film->getId();
        $dto->manufacturer = $this->filmManufacturerDtoMapper->mapFilmManufacturerToOutputDto($film->getManufacturer());
        $dto->filmType = $film->getFilmType()->value;
        $dto->model = $film->getModel();
        $dto->speed = $film->getSpeed();

        return $dto;
    }
}
