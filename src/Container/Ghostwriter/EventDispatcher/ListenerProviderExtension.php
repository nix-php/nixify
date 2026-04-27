<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Container\Ghostwriter\EventDispatcher;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\EventDispatcher\ListenerProvider;
use Ghostwriter\Nixify\Configuration\NixifyConfiguration;
use Override;
use Throwable;

use function assert;

/**
 * @see ListenerProviderExtensionTest
 *
 * @implements ExtensionInterface<ListenerProvider>
 */
final readonly class ListenerProviderExtension implements ExtensionInterface
{
    /**
     * @param ListenerProvider $service
     *
     * @throws Throwable
     */
    #[Override]
    public function __invoke(ContainerInterface $container, object $service): void
    {
        assert($service instanceof ListenerProvider);

        $configuration = $container->get(NixifyConfiguration::class);

        $eventListeners = $configuration->get('ghostwriter.event-dispatcher', []);

        foreach ($eventListeners as $event => $listeners) {
            foreach ($listeners as $listener) {
                $service->listen($event, $listener);
            }
        }
    }
}
