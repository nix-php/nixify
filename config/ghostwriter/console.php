<?php

declare(strict_types=1);

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
    'default_command'  => 'list',
    'catch_errors'     => true,
    'catch_exceptions' => true,
    'commands' => [],
];
