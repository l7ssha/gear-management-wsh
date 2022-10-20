<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Security\PredefinedRoles;
use App\Utils\Migrations\AbstractRoleMigration;

final class Version20221020153303 extends AbstractRoleMigration
{
    public function getDescription(): string
    {
        return 'Add display users role';
    }

    public function getRolesToAdd(): array
    {
        return [
            PredefinedRoles::ROLE_DISPLAY_USERS
        ];
    }

    public function getUserToAddRoleTo(): array
    {
        return [];
    }
}
