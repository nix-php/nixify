<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Interface;

interface NixifyInterface
{
    public function run(array $arguments = []): int;
}
