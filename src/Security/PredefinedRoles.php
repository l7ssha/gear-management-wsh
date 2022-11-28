<?php

namespace App\Security;

interface PredefinedRoles
{
    public const ROLE_DISPLAY_USERS = 'DISPLAY_USERS';
    public const ROLE_MANAGE_FILM_MANUFACTURER = 'MANAGE_FILM_MANUFACTURER';

    public const ROLE_DESCRIPTIONS = [
        self::ROLE_DISPLAY_USERS => 'Allows to display users',
        self::ROLE_MANAGE_FILM_MANUFACTURER => 'Allows to manage film manufacturers',
    ];

    public const ROLE_IDS = [
        self::ROLE_DISPLAY_USERS => '01GFTZ7YHFZPQTVCJXWKBQR9X6',
        self::ROLE_MANAGE_FILM_MANUFACTURER => '01GJSNH1QNDJSWJ7DW85B57S7Y',
    ];
}
