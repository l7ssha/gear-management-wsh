<?php

namespace App\Utils\Messenger;

use ApiPlatform\Symfony\Messenger\RemoveStamp;
use App\Exception\NotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlerDescriptor;
use Symfony\Component\Messenger\Handler\HandlersLocatorInterface;

class WrappingHandlersLocator implements HandlersLocatorInterface
{
    public function __construct(
        private readonly HandlersLocatorInterface $decorated,
        private readonly RequestStack $requestStack,
        private readonly ManagerRegistry $managerRegistry
    ) {
    }

    public function getHandlers(Envelope $envelope): iterable
    {
        /** @var iterable<int, HandlerDescriptor> $handlerDescriptors */
        $handlerDescriptors = $this->decorated->getHandlers($envelope);
        $message = $envelope->getMessage();

        $hasRemoveStamp = $envelope->last(RemoveStamp::class) !== null;

        foreach ($handlerDescriptors as $handlerDescriptor) {
            [$className] = explode(':', $handlerDescriptor->getName());
            $classUses = class_uses($className);

            if ($hasRemoveStamp && !in_array(DeleteHandlerTrait::class, $classUses, true)) {
                yield $this->getDescriptor($handlerDescriptor, [$message], 'api-platform-delete');
                continue;
            }

            $args = [$message];
            if (in_array(ProvideEntity::class, $classUses, true)) {
                $args = array_merge($args, $this->processProvideEntity());
            }

            return yield $this->getDescriptor($handlerDescriptor, $args);
        }
    }

    protected function processProvideEntity(): array
    {
        /** @var object|null $entity */
        $entity = $this->requestStack->getCurrentRequest()?->attributes->get('previous_data');
        if ($entity === null) {
            throw new NotFoundException('Cannot access previous entity data');
        }

        $entityManagerForEntity = $this->managerRegistry->getManagerForClass($entity::class);
        $entityRepository = $entityManagerForEntity->getRepository($entity::class);

        $fetchedObject = $entityRepository->find($entity);
        if ($fetchedObject === null) {
            throw new NotFoundException(sprintf('Entity of class: %s with id: %s not found', $entity::class, $entity->getId()));
        }

        return [$fetchedObject];
    }

    protected function getDescriptor(HandlerDescriptor $innerDescriptor, array $parameters, string $suffix = ''): HandlerDescriptor
    {
        return new HandlerDescriptor(
            fn () => $innerDescriptor->getHandler()(...$parameters),
            [
                'alias' => $innerDescriptor->getName().$suffix,
            ]
        );
    }
}
