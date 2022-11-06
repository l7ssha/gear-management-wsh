<?php

namespace App\Provider\Camera;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\UserRepository;
use App\Security\TokenUserProvider;

class UserStatsProvider implements ProviderInterface
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly TokenUserProvider $tokenUserProvider
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return $this->userRepository->getStatsForUser($this->tokenUserProvider->getCurrentUser());
    }
}
