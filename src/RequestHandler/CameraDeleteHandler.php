<?php

namespace App\RequestHandler;

use App\Entity\Gear\Camera;
use App\Repository\CameraRepository;
use App\Utils\Messenger\DeleteHandlerTrait;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CameraDeleteHandler implements MessageHandlerInterface
{
    use DeleteHandlerTrait;

    public function __construct(private readonly CameraRepository $cameraRepository)
    {
    }

    public function __invoke(Camera $camera): void
    {
        $this->cameraRepository->remove($camera);
    }
}
