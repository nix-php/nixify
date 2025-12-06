<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Console\Command;

use Override;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

use function str_repeat;

/** @see LockCommandTest */
#[AsCommand(name: 'lock', description: 'Locks Nix dependencies to latest versions.')]
final class LockCommand extends AbstractCommand
{
    /** @throws Throwable */
    #[Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([$this->getName(), str_repeat('=', 12)]);

        $workspace = $this->workspace($input);

        $this->process(command: ['nix', 'flake', 'update'], workingDirectory: $workspace);

        $this->process(command: ['nix', 'flake', 'lock'], workingDirectory: $workspace);

        return self::SUCCESS;
    }
}
