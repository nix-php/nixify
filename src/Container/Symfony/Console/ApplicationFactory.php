<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Container\Symfony\Console;

use Composer\InstalledVersions;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Nixify\Configuration\NixifyConfiguration;
use Override;
use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;

use Throwable;

use function is_string;

/**
 * @see ApplicationFactoryTest
 *
 * @implements FactoryInterface<Application>
 */
final readonly class ApplicationFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): Application
    {
        $nixifyConfiguration = $container->get(NixifyConfiguration::class);

        $consoleConfiguration = $nixifyConfiguration->wrap('ghostwriter.console');

        $version = InstalledVersions::getPrettyVersion($consoleConfiguration->get('package', 'ghostwriter/nixify'))
            ?? throw new RuntimeException('Unable to determine console application version.');

        $application = new Application($consoleConfiguration->get('name', 'Ghostwriter Nixify Console'), $version);

        $application->setAutoExit($consoleConfiguration->get('auto_exit', false));

        $application->setCatchErrors($consoleConfiguration->get('catch_errors', false));

        $application->setCatchExceptions($consoleConfiguration->get('catch_exceptions', false));

        $application->setCommandLoader(new ContainerCommandLoader(
            $container->get(\Psr\Container\ContainerInterface::class),
            $consoleConfiguration->get('commands', [])
        ));

        foreach ($consoleConfiguration->get('command', []) as $command) {
            $application->addCommand($container->get($command));
        }

        $defaultCommand = $consoleConfiguration->get('default_command', false);
        if (! is_string($defaultCommand)) {
            return $application;
        }

        $singleCommand = $consoleConfiguration->get('single_command', false);

        $application->setDefaultCommand($defaultCommand, true === $singleCommand);

        return $application;
    }
}
