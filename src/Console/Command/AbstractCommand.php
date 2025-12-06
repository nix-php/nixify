<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Console\Command;

use Ghostwriter\Filesystem\Interface\FilesystemInterface;
use InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Process\Process;
use Throwable;

use function is_dir;
use function sprintf;

abstract class AbstractCommand extends Command
{
    public function __construct(
        protected readonly FilesystemInterface $filesystem,
        protected readonly StyleInterface $style,
    ) {
        parent::__construct();
    }

    final protected function configure(): void
    {
        $this->addArgument(
            name: 'workspace',
            mode: InputArgument::OPTIONAL,
            description: 'The path where the file will be created.',
            default: $this->filesystem->currentWorkingDirectory(),
        );

        $this->addOption(
            name: 'force',
            shortcut: 'f',
            mode: InputOption::VALUE_NONE,
            description: 'Overwrite existing file.',
        );
    }

    /** @throws Throwable */
    final protected function force(InputInterface $input): bool
    {
        return $input->getOption('force') === true;
    }

    /** @throws Throwable */
    final protected function input(string $command, bool $force, string $workspace): ArrayInput
    {
        $parameters = [
            'command' => $command,
            'workspace' => $workspace,
        ];

        if ($force) {
            $parameters['--force'] = true;
        }

        return new ArrayInput($parameters);
    }

    final protected function process(
        array $command,
        string $workingDirectory,
        ?array $environmentVariables = null,
        null|float|int $timeout = null,
    ): Process {
        $process = new Process(
            command: $command,
            cwd: $workingDirectory,
            env: $environmentVariables,
            timeout: $timeout,
        );

        $style = $this->style;

        $process->mustRun(static function ($type, string $buffer) use ($style): void {
            if (Process::ERR === $type) {
                $style->error($buffer);

                return;
            }
            $style->info($buffer);
        });

        $style->info(sprintf('Command "%s" executed successfully.', $process->getCommandLine()));

        return $process;
    }

    /** @throws Throwable */
    final protected function workspace(InputInterface $input): string
    {
        $workspace = $input->getArgument('workspace');

        if (! is_dir($workspace)) {
            throw new InvalidArgumentException(sprintf('The workspace path "%s" is not a directory.', $workspace));
        }

        return $workspace;
    }
}
