<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Container;

use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Nixify\Configuration\NixifyConfiguration;
use Override;
use Throwable;

use const DIRECTORY_SEPARATOR;

use function dirname;
use function implode;

/**
 * @see NixifyProviderTest
 */
final class NixifyProvider extends AbstractProvider
{
    /** @throws Throwable */
    #[Override]
    public function register(BuilderInterface $builder): void
    {
        $configuration = NixifyConfiguration::new();
        $configuration->mergeDirectory(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__, 2), 'config']));
        $builder->set(NixifyConfiguration::class, $configuration);

        $containerConfiguration = $configuration->wrap('ghostwriter/container');

        foreach ($containerConfiguration->get('alias', []) as $alias => $service) {
            $builder->alias($service, $alias);
        }

        foreach ($containerConfiguration->get('define', []) as $definition) {
            $builder->define($definition);
        }

        foreach ($containerConfiguration->get('extend', []) as $service => $extensions) {
            foreach ($extensions as $extension) {
                $builder->extend($service, $extension);
            }
        }

        foreach ($containerConfiguration->get('factory', []) as $service => $factory) {
            $builder->factory($service, $factory);
        }
    }
}
