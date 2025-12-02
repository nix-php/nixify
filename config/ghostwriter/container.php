<?php

declare(strict_types=1);

use Ghostwriter\Config\Interface\ConfigurationInterface;
use Ghostwriter\Container\Interface\Service\DefinitionInterface;
use Ghostwriter\Container\Interface\Service\ExtensionInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Nixify\Container\Ghostwriter\Config\ConfigurationExtension;

/**
 * @return array{
 *     'alias': array<class-string,class-string>,
 *     'define': array<class-string,class-string<DefinitionInterface>>,
 *     'extend': array<class-string,list<class-string<ExtensionInterface>>>,
 *     'factory': array<class-string,class-string<FactoryInterface>>
 * }
 */
return [
    'alias' => [
        // 'Some\Interface' => 'Some\Implementation',
    ],
    'define' => [
        // 'Some\ServiceDefinition',
    ],
    'extend' => [
        // 'Some\Service' => ['Some\ServiceExtension'],
        ConfigurationInterface::class => [ConfigurationExtension::class],
    ],
    'factory' => [
        // 'Some\Service' => 'Some\ServiceFactory',
    ],
];
