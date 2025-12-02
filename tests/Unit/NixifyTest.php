<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Nixify\Interface\NixifyInterface;
use Ghostwriter\Nixify\Nixify;
use PHPUnit\Framework\Attributes\CoversClass;
use Throwable;

use function is_a;

#[CoversClass(Nixify::class)]
final class NixifyTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsNixifyInterface(): void
    {
        self::assertTrue(is_a(Nixify::class, NixifyInterface::class, true));
    }
}
