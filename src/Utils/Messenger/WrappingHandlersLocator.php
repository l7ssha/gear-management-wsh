<?php

namespace App\Utils\Messenger;

use ApiPlatform\Symfony\Messenger\RemoveStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlerDescriptor;
use Symfony\Component\Messenger\Handler\HandlersLocatorInterface;

class WrappingHandlersLocator implements HandlersLocatorInterface
{
    public function __construct(private readonly HandlersLocatorInterface $decorated)
    {
    }

    public function getHandlers(Envelope $envelope): iterable
    {
        /** @var iterable<int, HandlerDescriptor> $handlerDescriptors */
        $handlerDescriptors = $this->decorated->getHandlers($envelope);
        $message = $envelope->getMessage();

        if ($envelope->last(RemoveStamp::class) === null) {
            return $handlerDescriptors;
        }

        foreach ($handlerDescriptors as $handlerDescriptor) {
            [$className] = explode(':', $handlerDescriptor->getName());
            if (!in_array(DeleteHandlerTrait::class, class_uses($className))) {
                continue;
            }

            yield new HandlerDescriptor(
                fn () => $handlerDescriptor->getHandler()($message),
                [
                    'alias' => $handlerDescriptor->getName().'api-platform-delete',
                ]
            );
        }
    }
}
