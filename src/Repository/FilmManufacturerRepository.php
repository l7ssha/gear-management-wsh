<?php

namespace App\Repository;

use App\Entity\Film\FilmManufacturer;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class FilmManufacturerRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function save(FilmManufacturer $camera): void
    {
        $this->manager->getManager()->persist($camera);
        $this->manager->getManager()->flush();
    }

    public function remove(FilmManufacturer $camera): void
    {
        $this->manager->getManager()->remove($camera);
        $this->manager->getManager()->flush();
    }

    /**
     * @return EntityRepository<FilmManufacturer>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(FilmManufacturer::class);
    }
}
