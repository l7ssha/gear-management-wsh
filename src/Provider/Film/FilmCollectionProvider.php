<?php

namespace App\Provider\Film;

use ApiPlatform\Doctrine\Orm\Paginator;
use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiPlatform\Provider\ApiPlatformCollectionProviderTrait;
use App\Entity\Film\Film;
use App\Mapper\FilmDtoMapper;

class FilmCollectionProvider implements ProviderInterface
{
    use ApiPlatformCollectionProviderTrait;

    public function __construct(
        private readonly FilmDtoMapper $filmDtoMapper,
        private readonly CollectionProvider $collectionProvider
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /** @var Paginator $paginator */
        $paginator = $this->collectionProvider->provide($operation, $uriVariables, $context);

        return $this->getCollectionProvider(
            $paginator,
            fn (Film $film) => $this->filmDtoMapper->mapFilmToOutputDto($film)
        );
    }
}
