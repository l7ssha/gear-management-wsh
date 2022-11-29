<?php

namespace App\Dto\Film;

use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;

class FilmOutputDto
{
    public string $id;
    public FilmManufacturerOutputDto $manufacturer;
    public string $filmType;
    public string $model;
    public int $speed;
}
