<?php

namespace App\Repository;

use App\Entity\Gear\CameraSystem;
use App\Exception\CameraSystemNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class CameraSystemRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function findByName(string $name): ?CameraSystem
    {
        return $this->getRepository()->findOneBy(['name' => $name]);
    }

    public function getByName(string $name): CameraSystem
    {
        return $this->findByName($name) ?? throw CameraSystemNotFoundException::fromName($name);
    }

    /**
     * @return EntityRepository<CameraSystem>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(CameraSystem::class);
    }
}
