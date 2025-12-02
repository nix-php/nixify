<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Ghostwriter\Nixify\Container\NixifyDefinition;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;
use Throwable;

use function is_a;

#[CoversClass(NixifyDefinition::class)]
final class NixifyDefinitionTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsDefinitionInterface(): void
    {
        self::assertTrue(is_a(NixifyDefinition::class, DefinitionInterface::class, true));
    }
}
