<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Ghostwriter\EventDispatcher;

use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\Nixify\Container\Ghostwriter\EventDispatcher\ListenerProviderExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ListenerProviderExtension::class)]
final class ListenerProviderExtensionTest extends AbstractTestCase
{
    public function testImplementsExtensionInterface(): void
    {
        self::assertInstanceOf(ExtensionInterface::class, new ListenerProviderExtension());
    }
}
