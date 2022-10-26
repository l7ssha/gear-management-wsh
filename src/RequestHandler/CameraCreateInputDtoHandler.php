<?php

namespace App\RequestHandler;

use App\Dto\Gear\Camera\CameraCreateInputDto;
use App\Entity\Gear\Camera;
use App\Repository\CameraProducerRepository;
use App\Repository\CameraRepository;
use App\Repository\CameraSystemRepository;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CameraCreateInputDtoHandler implements MessageHandlerInterface
{
    public function __construct(
        private readonly CameraRepository $cameraRepository,
        private readonly CameraProducerRepository $cameraProducerRepository,
        private readonly CameraSystemRepository $cameraSystemRepository,
        private readonly TokenStorageInterface $tokenStorage,
        private readonly UserRepository $userRepository
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
            ->setCreatedBy(
                $this->userRepository->getByUsernameOrEmail(
                    $this->tokenStorage->getToken()->getUserIdentifier()
                )
            )
        ;

        $this->cameraRepository->save($camera);

        return $camera;
    }
}
