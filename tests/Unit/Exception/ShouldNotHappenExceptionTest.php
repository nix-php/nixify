<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use Ghostwriter\Nixify\Exception\ShouldNotHappenException;
use Ghostwriter\Nixify\Interface\NixifyExceptionInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;
use Throwable;

use function is_a;

#[CoversClass(ShouldNotHappenException::class)]
final class ShouldNotHappenExceptionTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsExceptionInterface(): void
    {
        self::assertTrue(is_a(ShouldNotHappenException::class, NixifyExceptionInterface::class, true));
    }
}
