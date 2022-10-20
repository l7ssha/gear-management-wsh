<?php

namespace App\Security;

use App\Entity\Auth\User;
use DateInterval;
use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();
        if (!$user instanceof User) {
            return;
        }

        $event->setData(
            array_merge($event->getData(), $this->getPayloadData($user))
        );
    }

    private function getPayloadData(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
    }
}
