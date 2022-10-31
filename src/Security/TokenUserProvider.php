<?php

namespace App\Security;

use App\Entity\Auth\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TokenUserProvider
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TokenStorageInterface $tokenStorage
    ) {
    }

    public function getCurrentUser(): User
    {
        return $this->userRepository->getByUsernameOrEmail(
            $this->tokenStorage->getToken()->getUserIdentifier()
        );
    }
}
