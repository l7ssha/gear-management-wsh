<?php

namespace App\RequestHandler;

use App\Entity\Film\FilmManufacturer;
use App\Repository\FilmManufacturerRepository;
use App\Utils\Messenger\DeleteHandlerTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FilmManufacturerDeleteHandler implements MessageHandlerInterface
{
    use DeleteHandlerTrait;

    public function __construct(private readonly FilmManufacturerRepository $filmManufacturerRepository)
    {
    }

    public function __invoke(FilmManufacturer $filmManufacturer): void
    {
        $this->filmManufacturerRepository->remove($filmManufacturer);
    }
}
