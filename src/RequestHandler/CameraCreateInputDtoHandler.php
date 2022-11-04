<?php

namespace App\RequestHandler;

use ApiPlatform\Validator\ValidatorInterface;
use App\Dto\Gear\Camera\CameraCreateInputDto;
use App\Entity\Gear\Camera;
use App\Repository\CameraProducerRepository;
use App\Repository\CameraRepository;
use App\Repository\CameraSystemRepository;
use App\Security\TokenUserProvider;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CameraCreateInputDtoHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly CameraRepository $cameraRepository,
        private readonly CameraProducerRepository $cameraProducerRepository,
        private readonly CameraSystemRepository $cameraSystemRepository,
        private readonly TokenUserProvider $tokenUserProvider,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function __invoke(CameraCreateInputDto $dto): Camera
    {
        $camera = new Camera();
        $camera
            ->setProducer($this->cameraProducerRepository->getByName($dto->producer->name))
            ->setModel($dto->model)
            ->setType($dto->type)
            ->setFormat($dto->format)
            ->setSystem($this->cameraSystemRepository->getByName($dto->system->name))
            ->setSerialNumber($dto->serialNumber)
            ->setSerialNumberAlternative($dto->serialNumberAlternative)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setCreatedBy($this->tokenUserProvider->getCurrentUser())
        ;

        $this->validator->validate($camera);
        $this->cameraRepository->save($camera);

        return $camera;
    }
}
