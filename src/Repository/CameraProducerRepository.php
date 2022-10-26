<?php

namespace App\Repository;

use App\Entity\Gear\CameraProducer;
use App\Exception\CameraProducerNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class CameraProducerRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function findByName(string $name): ?CameraProducer
    {
        return $this->getRepository()->findOneBy(['name' => $name]);
    }

    public function getByName(string $name): CameraProducer
    {
        return $this->findByName($name) ?? throw CameraProducerNotFoundException::fromName($name);
    }

    /**
     * @return EntityRepository<CameraProducer>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(CameraProducer::class);
    }
}
