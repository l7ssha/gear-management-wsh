<?php

namespace App\Repository;

use App\Dto\UserStatsOutputDto;
use App\Entity\Auth\User;
use App\Entity\Gear\Camera;
use App\Entity\Gear\Lens;
use App\Exception\NotFound\UserNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class UserRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
    }

    public function getStatsForUser(User $user): UserStatsOutputDto
    {
        return $this->getRepository()->createQueryBuilder('u')
            ->select('NEW App\Dto\UserStatsOutputDto(COUNT(c.id), COUNT(l.id))')
            ->leftJoin(Camera::class, 'c', 'WITH', 'c.createdBy = :userToFind')
            ->leftJoin(Lens::class, 'l', 'WITH', 'l.createdBy = :userToFind')
            ->setParameter('userToFind', $user)
            ->getQuery()
            ->getSingleResult();
    }

    public function findByUsernameOrEmail(string $identifier): ?User
    {
        return $this->getRepository()->createQueryBuilder('u')
            ->where('u.username = :identifier')
            ->orWhere('u.email = :identifier')
            ->setParameter('identifier', $identifier)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getByUsernameOrEmail(string $identifier): User
    {
        return $this->findByUsernameOrEmail($identifier) ?? throw UserNotFoundException::fromUserUsernameOrEmail($identifier);
    }

    public function findById(string $id): ?User
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function save(User $user): void
    {
        $this->manager->getManager()->persist($user);
        $this->manager->getManager()->flush();
    }

    /**
     * @return EntityRepository<User>
     */
    public function getRepository(): ObjectRepository
    {
        return $this->manager->getRepository(User::class);
    }
}
