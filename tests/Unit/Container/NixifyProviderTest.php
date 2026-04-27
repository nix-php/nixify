<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Container\Interface\Service\ProviderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Nixify\Container\NixifyProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(NixifyProvider::class)]
final class NixifyProviderTest extends AbstractTestCase
{
    public function testExtendsAbstractProvider(): void
    {
        self::assertInstanceOf(AbstractProvider::class, new NixifyProvider());
    }

    public function testImplementsProviderInterface(): void
    {
        self::assertInstanceOf(ProviderInterface::class, new NixifyProvider());
    }
}
