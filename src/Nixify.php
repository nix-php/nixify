<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify;

use Ghostwriter\Container\Container;
use Ghostwriter\Nixify\Interface\NixifyInterface;
use Override;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Throwable;

/** @see NixifyTest */
final readonly class Nixify implements NixifyInterface
{
    public function __construct(
        private Application $application,
    ) {}

    /** @throws Throwable */
    public static function new(): self
    {
        return Container::getInstance()->get(self::class);
    }

    /** @throws Throwable */
    #[Override]
    public function run(array $arguments = []): int
    {
        return $this->application->run(new ArgvInput($arguments));
    }
}
