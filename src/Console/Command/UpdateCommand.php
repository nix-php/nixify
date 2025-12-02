<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Console\Command;

use Override;
use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

use function str_repeat;

/** @see UpdateCommandTest */
#[AsCommand(name: 'update', description: 'Updates Nix files to the latest version.')]
final class UpdateCommand extends AbstractCommand
{
    /** @throws Throwable */
    #[Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([$this->getName(), str_repeat('=', 12)]);

        $application = $this->getApplication();
        if (! $application instanceof Application) {
            throw new RuntimeException('Application instance is not available.');
        }

        $workspace = $input->getArgument('workspace');

        $force = $input->getOption('force');

        $this->runCommand('make:default-nix', $application, $workspace, $force, $output);
        $this->runCommand('make:flake-nix', $application, $workspace, $force, $output);
        $this->runCommand('make:shell-nix', $application, $workspace, $force, $output);

        $this->runCommand('lock', $application, $workspace, $force, $output);

        return self::SUCCESS;
    }
}
