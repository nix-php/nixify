<?php

declare(strict_types=1);

namespace Tests\Unit\Console\Command;

use Ghostwriter\Filesystem\Interface\FilesystemInterface;
use Ghostwriter\Nixify\Console\Command\AbstractCommand;
use Ghostwriter\Nixify\Console\Command\LockCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Console\Style\StyleInterface;
use Tests\Unit\AbstractTestCase;

#[CoversClass(LockCommand::class)]
final class LockCommandTest extends AbstractTestCase
{
    public function testExtendsAbstractCommand(): void
    {
        $filesystem = $this->createMock(FilesystemInterface::class);
        $filesystem->expects(self::once())
            ->method('currentWorkingDirectory')
            ->seal();

        $style = $this->createMock(StyleInterface::class);
        $style->expects(self::never())
            ->method('title')
            ->seal();
        self::assertInstanceOf(AbstractCommand::class, new LockCommand($filesystem, $style));
    }
}
