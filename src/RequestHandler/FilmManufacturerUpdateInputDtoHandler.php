<?php

namespace App\RequestHandler;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;
use App\Dto\FilmManufacturer\FilmManufacturerUpdateInputDto;
use App\Entity\Film\FilmManufacturer;
use App\Mapper\FilmManufacturerDtoMapper;
use App\Repository\FilmManufacturerRepository;
use App\Security\TokenUserProvider;
use App\Utils\Messenger\ProvideEntity;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FilmManufacturerUpdateInputDtoHandler implements MessageHandlerInterface
{
    use ProvideEntity;

    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly FilmManufacturerRepository $filmManufacturerRepository,
        private readonly FilmManufacturerDtoMapper $filmManufacturerDtoMapper,
        private readonly TokenUserProvider $tokenUserProvider
    ) {
    }

    public function __invoke(FilmManufacturerUpdateInputDto $dto, FilmManufacturer $entity): FilmManufacturerOutputDto
    {
        $entity->setName($dto->name);

        $this->validator->validate($entity);
        $this->filmManufacturerRepository->save($entity);

        return $this->filmManufacturerDtoMapper->mapFilmManufacturerToOutputDto($entity);
    }
}
