<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Console\Command;

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

/** @see MakeDefaultNixCommandTest */
#[AsCommand(name: 'make:default-nix', description: 'Generates a default.nix file for the project.')]
final class MakeDefaultNixCommand extends AbstractCommand
{
    /** @throws Throwable */
    #[Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([$this->getName(), str_repeat('=', 12)]);

        $force = $this->force($input);
        $workspace = $this->workspace($input);

        $path = $workspace . DIRECTORY_SEPARATOR . 'default.nix';

        if (! $force && $this->filesystem->isFile($path)) {
            $output->writeln(sprintf('<comment>skipped</comment> %s (file exists)', $path));

            return self::SUCCESS;
        }

        $output->writeln(sprintf('<info>creating</info> %s', $path));

        $this->filesystem->write($path, $this->generateDefaultNix());

        return self::SUCCESS;
    }

    private function generateDefaultNix(): string
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
            ').defaultNix',
            '',
        ]);
    }
}
