<?php

namespace App\Tests\api\User;

use App\Security\PredefinedRoles;
use App\Tests\api\AuthenticatedWebTestCase;

class GetUserStats extends AuthenticatedWebTestCase
{
    public function testGetUserStats(): void
    {
        $client = self::createClientWithRoles(['ROLE_'.PredefinedRoles::ROLE_DISPLAY_USERS]);

        $response = $client->request('GET', '/api/users/stats');
        self::assertHttpResponseStatusCodeSame(200, $response);

        $responseData = $response->toArray();
        self::assertArrayHasKey('cameraCount', $responseData);
        self::assertArrayHasKey('lensCount', $responseData);
    }
}
