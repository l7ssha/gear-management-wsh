<?php

namespace App\RequestHandler;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\FilmManufacturer\FilmManufacturerCreateInputDto;
use App\Dto\FilmManufacturer\FilmManufacturerOutputDto;
use App\Entity\Film\FilmManufacturer;
use App\Mapper\FilmManufacturerDtoMapper;
use App\Repository\FilmManufacturerRepository;
use App\Security\TokenUserProvider;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FilmManufacturerCreateInputDtoHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly FilmManufacturerRepository $filmManufacturerRepository,
        private readonly FilmManufacturerDtoMapper $filmManufacturerDtoMapper,
        private readonly TokenUserProvider $tokenUserProvider
    ) {
    }

    public function __invoke(FilmManufacturerCreateInputDto $dto): FilmManufacturerOutputDto
    {
        $entity = new FilmManufacturer();
        $entity->setName($dto->name);
        $entity->setCreatedAt(new \DateTimeImmutable());
        $entity->setCreatedBy($this->tokenUserProvider->getCurrentUser());

        $this->validator->validate($entity);
        $this->filmManufacturerRepository->save($entity);

        return $this->filmManufacturerDtoMapper->mapFilmManufacturerToOutputDto($entity);
    }
}
