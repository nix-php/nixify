<?php

declare(strict_types=1);

use Ghostwriter\Nixify\Console\Command\LockCommand;
use Ghostwriter\Nixify\Console\Command\MakeDefaultNixCommand;
use Ghostwriter\Nixify\Console\Command\MakeFlakeNixCommand;
use Ghostwriter\Nixify\Console\Command\MakeShellNixCommand;
use Ghostwriter\Nixify\Console\Command\UpdateCommand;
use Symfony\Component\Console\Command\Command;

/**
 * @return array{
 *     name: string,
 *     package: string,
 *     auto_exit: bool,
 *     single_command: bool,
 *     default_command: string,
 *     catch_errors: bool,
 *     catch_exceptions: bool,
 *     commands: class-string<Command>
 * }
 */
return [
    'name' => 'Nixify',
    'package' => 'ghostwriter/nixify',
    'auto_exit'       => false,
    'single_command'       => false,
    'default_command'  => 'update',
    'catch_errors'     => true,
    'catch_exceptions' => true,
    'commands' => [
        'lock'             => LockCommand::class,
        'make:default-nix' => MakeDefaultNixCommand::class,
        'make:flake-nix'   => MakeFlakeNixCommand::class,
        'make:shell-nix'   => MakeShellNixCommand::class,
        'update'           => UpdateCommand::class,
    ],
];
