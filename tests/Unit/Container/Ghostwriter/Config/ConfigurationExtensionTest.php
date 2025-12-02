<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Ghostwriter\Config;

use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\Nixify\Container\Ghostwriter\Config\ConfigurationExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;
use Throwable;

use function is_a;

#[CoversClass(ConfigurationExtension::class)]
final class ConfigurationExtensionTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsExtensionInterface(): void
    {
        self::assertTrue(is_a(ConfigurationExtension::class, ExtensionInterface::class, true));
    }
}
