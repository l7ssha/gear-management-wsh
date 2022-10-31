<?php

namespace App\Repository;

use App\Entity\Auth\User;
use App\Exception\NotFound\UserNotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

class UserRepository
{
    public function __construct(private readonly ManagerRegistry $manager)
    {
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
        return $this->findByUsernameOrEmail($identifier) ?? throw UserNotFoundException::fromUserUsername($identifier);
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
