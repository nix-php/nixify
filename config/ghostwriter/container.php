<?php

declare(strict_types=1);

use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\EventDispatcher\ListenerProvider;
use Ghostwriter\Nixify\Container\Ghostwriter\EventDispatcher\ListenerProviderExtension;
use Ghostwriter\Nixify\Container\Symfony\Console\ApplicationFactory;
use Ghostwriter\Nixify\Interface\NixifyInterface;
use Ghostwriter\Nixify\Nixify;
use Symfony\Component\Console\Application;

/**
 * @return array{
 *     'alias': array<class-string,class-string>,
 *     'extend': array<class-string,list<class-string<ExtensionInterface>>>,
 *     'factory': array<class-string,class-string<FactoryInterface>>
 * }
 */
return [
    'alias' => [
        NixifyInterface::class => Nixify::class,
    ],
    'extend' => [
        ListenerProvider::class => [ListenerProviderExtension::class],
    ],
    'factory' => [
        Application::class => ApplicationFactory::class,
    ],
];
