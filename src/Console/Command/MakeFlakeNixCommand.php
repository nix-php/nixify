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

/** @see MakeFlakeNixCommandTest */
#[AsCommand(name: 'make:flake-nix', description: 'Generates a flake.nix file for the project.')]
final class MakeFlakeNixCommand extends AbstractCommand
{
    /** @throws Throwable */
    #[Override]
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([$this->getName(), str_repeat('=', 12)]);
        $workspace = $this->workspace($input);

        $path = $workspace . DIRECTORY_SEPARATOR . 'flake.nix';

        if ($this->filesystem->isFile($path)) {
            $output->writeln(sprintf('<comment>skipped</comment> %s (file exists)', $path));

            return self::SUCCESS;
        }

        $output->writeln(sprintf('<info>creating</info> %s', $path));

        $this->filesystem->write($path, $this->generateFlakeNix());

        $nixPath = $workspace . DIRECTORY_SEPARATOR . 'nix';
        if (! $this->filesystem->isDirectory($nixPath)) {
            $this->filesystem->write($nixPath . DIRECTORY_SEPARATOR . '.gitignore', "!.gitignore\n");
        }

        return self::SUCCESS;
    }

    private function generateFlakeNix(): string
    {
        return implode(PHP_EOL, [
            '{',
            '  inputs.flake-compat.url = "github:NixOS/flake-compat";',
            '  inputs.flake-parts.url = "github:hercules-ci/flake-parts";',
            '  inputs.import-tree.url = "github:vic/import-tree";',
            '  inputs.nixpkgs.url = "github:NixOS/nixpkgs";',
            '',
            '  outputs = inputs: inputs.flake-parts.lib.mkFlake {inherit inputs;} (inputs.import-tree ./nix);',
            '}',
            '',
        ]);
    }
}
