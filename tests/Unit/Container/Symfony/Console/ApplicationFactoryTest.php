<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Symfony\Console;

use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Nixify\Container\Symfony\Console\ApplicationFactory;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

#[CoversClass(ApplicationFactory::class)]
final class ApplicationFactoryTest extends AbstractTestCase
{
    public function testImplementsFactoryInterface(): void
    {
        self::assertInstanceOf(FactoryInterface::class, new ApplicationFactory());
    }
}
