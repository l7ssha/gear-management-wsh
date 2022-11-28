<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Security\PredefinedRoles;
use App\Utils\Migrations\AbstractRoleMigration;

final class Version20221126173327 extends AbstractRoleMigration
{
    public function getDescription(): string
    {
        return 'Add '.PredefinedRoles::ROLE_MANAGE_FILM_MANUFACTURER.' role';
    }

    public function getRolesToAdd(): array
    {
        return [
            PredefinedRoles::ROLE_MANAGE_FILM_MANUFACTURER,
        ];
    }

    public function getUserToAddRoleTo(): array
    {
        return [];
    }
}
