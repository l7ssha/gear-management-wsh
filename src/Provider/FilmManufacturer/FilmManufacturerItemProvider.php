<?php

namespace App\Provider\FilmManufacturer;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;
use App\Entity\Film\FilmManufacturer;
use App\Mapper\FilmManufacturerDtoMapper;

class FilmManufacturerItemProvider implements ProviderInterface
{
    public function __construct(
        private readonly FilmManufacturerDtoMapper $dtoMapper,
        private readonly ItemProvider $itemProvider
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?FilmManufacturerOutputDto
    {
        /** @var FilmManufacturer|null $object */
        $object = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($object === null) {
            return null;
        }

        return $this->dtoMapper->mapFilmManufacturerToOutputDto($object);
    }
}
