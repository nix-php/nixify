<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Console\Command\Make;

use Ghostwriter\Nixify\Console\Command\AbstractCommand;
use Override;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

use const DIRECTORY_SEPARATOR;
use const PHP_EOL;

use function implode;
use function sprintf;
use function str_repeat;

/** @see MakeShellNixCommandTest */
#[AsCommand(name: 'make:shell-nix', description: 'Generates a shell.nix file for the project.')]
final class MakeShellNixCommand extends AbstractCommand
{
    /** @throws Throwable */
    #[Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([$this->getName(), str_repeat('=', 12)]);

        $force = $this->force($input);
        $workspace = $this->workspace($input);

        $path = $workspace . DIRECTORY_SEPARATOR . 'shell.nix';

        if (! $force && $this->filesystem->isFile($path)) {
            $output->writeln(sprintf('<comment>skipped</comment> %s (file exists)', $path));

            return self::SUCCESS;
        }

        $output->writeln(sprintf('<info>creating</info> %s', $path));

        $this->filesystem->write($path, $this->generateShellNix());

        return self::SUCCESS;
    }

    private function generateShellNix(): string
    {
        return implode(PHP_EOL, [
            '(',
            '  import',
            '  (',
            '    let',
            '      lock = builtins.fromJSON (builtins.readFile ./flake.lock);',
            '      nodeName = lock.nodes.root.inputs.flake-compat;',
            '    in',
            '      fetchTarball {',
            '        url = lock.nodes.${nodeName}.locked.url or "https://github.com/NixOS/flake-compat/archive/${lock.nodes.${nodeName}.locked.rev}.tar.gz";',
            '        sha256 = lock.nodes.${nodeName}.locked.narHash;',
            '      }',
            '  ) {src = ./.;}',
            ').shellNix',
            '',
        ]);
    }
}
