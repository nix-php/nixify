<?php

declare(strict_types=1);

namespace Ghostwriter\Nixify\Exception;

use Ghostwriter\Nixify\Interface\NixifyExceptionInterface;
use LogicException;

final class ShouldNotHappenException extends LogicException implements NixifyExceptionInterface {}
