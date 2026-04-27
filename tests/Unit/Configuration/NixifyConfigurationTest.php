<?php

declare(strict_types=1);

namespace Tests\Unit\Configuration;

use Ghostwriter\Config\AbstractConfiguration;
use Ghostwriter\Nixify\Configuration\NixifyConfiguration;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(NixifyConfiguration::class)]
final class NixifyConfigurationTest extends AbstractTestCase
{
    public function testExtendsAbstractConfiguration(): void
    {
        self::assertInstanceOf(AbstractConfiguration::class, new NixifyConfiguration());
    }

    public function testImplementsConfigurationInterface(): void
    {
        self::assertInstanceOf(NixifyConfiguration::class, new NixifyConfiguration());
    }
}
