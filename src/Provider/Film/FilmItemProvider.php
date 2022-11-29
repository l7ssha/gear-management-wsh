<?php

namespace App\Provider\Film;

use ApiPlatform\Doctrine\Orm\State\ItemProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\Film\FilmOutputDto;
use App\Entity\Film\Film;
use App\Mapper\FilmDtoMapper;

class FilmItemProvider implements ProviderInterface
{
    public function __construct(
        private readonly FilmDtoMapper $filmDtoMapper,
        private readonly ItemProvider $itemProvider
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?FilmOutputDto
    {
        /** @var Film|null $object */
        $object = $this->itemProvider->provide($operation, $uriVariables, $context);
        if ($object === null) {
            return null;
        }

        return $this->filmDtoMapper->mapFilmToOutputDto($object);
    }
}
