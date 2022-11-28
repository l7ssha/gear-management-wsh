<?php

namespace App\Provider\FilmManufacturer;

use ApiPlatform\Doctrine\Orm\AbstractPaginator;
use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\Provider\ApiPlatformCollectionProviderTrait;
use App\Entity\Film\FilmManufacturer;
use App\Mapper\FilmManufacturerDtoMapper;

class FilmManufacturerCollectionProvider implements ProviderInterface
{
    use ApiPlatformCollectionProviderTrait;

    public function __construct(
        private readonly FilmManufacturerDtoMapper $filmManufacturerDtoMapper,
        private readonly CollectionProvider $collectionProvider
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): AbstractPaginator
    {
        /** @var Paginator $paginator */
        $paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return $this->getCollectionProvider(
            $paginator,
            fn (FilmManufacturer $filmManufacturer) => $this->filmManufacturerDtoMapper->mapFilmManufacturerToOutputDto($filmManufacturer)
        );
    }
}
