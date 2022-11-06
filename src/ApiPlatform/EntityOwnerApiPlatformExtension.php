<?php

namespace App\ApiPlatform;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Utils\Doctrine\CreatedAuditTrait;
use App\Utils\Doctrine\EntityOwnerTrait;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class EntityOwnerApiPlatformExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param class-string $resourceClass
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        $classUses = class_uses($resourceClass);

        $usesEntityOwnerTrait = in_array(EntityOwnerTrait::class, $classUses, true);
        $usesCreatedAuditTrait = in_array(CreatedAuditTrait::class, $classUses, true);

        if (!$usesEntityOwnerTrait || !$usesCreatedAuditTrait) {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->innerJoin(
                sprintf(
                    '%s.createdBy',
                    $rootAlias
                ),
                'cbu',
                'WITH',
                'cbu.email = :currentUserIdentifier OR cbu.username = :currentUserIdentifier'
            )
            ->setParameter('currentUserIdentifier', $this->tokenStorage->getToken()->getUser()->getUserIdentifier());
    }
}
