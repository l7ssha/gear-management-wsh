<?php

namespace App\Utils\Messenger;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HandlersLocatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $busses = $container->findTaggedServiceIds('messenger.bus');

        foreach (array_keys($busses) as $busId) {
            $decoratorId = "$busId.messenger.wrapping_handlers_locator";
            $originalLocatorId = "$busId.messenger.handlers_locator";

            $container->register($decoratorId, WrappingHandlersLocator::class)
                ->setAutowired(true)
                ->setDecoratedService($originalLocatorId);
        }
    }
}
