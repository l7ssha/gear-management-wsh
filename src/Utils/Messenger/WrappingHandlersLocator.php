<?php

namespace App\Utils\Messenger;

use ApiPlatform\Symfony\Messenger\RemoveStamp;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlerDescriptor;
use Symfony\Component\Messenger\Handler\HandlersLocatorInterface;

class WrappingHandlersLocator implements HandlersLocatorInterface
{
    private HandlersLocatorInterface $decorated;

    public function __construct(HandlersLocatorInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function getHandlers(Envelope $envelope): iterable
    {
        /** @var iterable<int, HandlerDescriptor> $handlerDescriptors */
        $handlerDescriptors = $this->decorated->getHandlers($envelope);
        $message = $envelope->getMessage();

        foreach ($handlerDescriptors as $handlerDescriptor) {
            if ($envelope->last(RemoveStamp::class) === null) {
                yield $handlerDescriptor;
            }

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
