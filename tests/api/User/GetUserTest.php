<?php

namespace App\Tests\api\User;

use App\Security\PredefinedRoles;
use App\Tests\api\AuthenticatedWebTestCase;

class GetUserTest extends AuthenticatedWebTestCase
{
    public function testUnAuthorized(): void
    {
        $client = self::createClient();

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(401, $response);
    }

    public function testMissingPermissions(): void
    {
        $client = self::createClientWithRoles([]);

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(403, $response);
    }

    public function testSuccess(): void
    {
        $client = self::createClientWithRoles(['ROLE_'.PredefinedRoles::ROLE_DISPLAY_USERS]);

        $response = $client->request('GET', '/api/users');
        self::assertHttpResponseStatusCodeSame(200, $response);

        $responseArray = $response->toArray();
        self::assertCount(1, $responseArray);
    }
}
