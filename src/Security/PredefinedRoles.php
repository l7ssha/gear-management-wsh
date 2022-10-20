<?php

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_USERS = 'DISPLAY_USERS';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_USERS => 'Allows to display users',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_USERS => '01GFTZ7YHFZPQTVCJXWKBQR9X6',
    ];
}
