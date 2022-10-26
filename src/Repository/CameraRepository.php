<?php

namespace App\Repository;

use App\Entity\Gear\Camera;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class CameraRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function save(Camera $camera): void
    {
        $this->manager->getManager()->persist($camera);
        $this->manager->getManager()->flush();
    }

    /**
     * @return EntityRepository<Camera>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(Camera::class);
    }
}
