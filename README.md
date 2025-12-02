# Nixify

[![GitHub Sponsors](https://img.shields.io/github/sponsors/ghostwriter?label=Sponsor+@nix-php/nixify&logo=GitHub+Sponsors)](https://github.com/sponsors/ghostwriter)
[![Automation](https://github.com/nix-php/nixify/actions/workflows/automation.yml/badge.svg)](https://github.com/nix-php/nixify/actions/workflows/automation.yml)
[![Supported PHP Version](https://badgen.net/packagist/php/nix-php/nixify?color=8892bf)](https://www.php.net/supported-versions)
[![Downloads](https://badgen.net/packagist/dt/nix-php/nixify?color=blue)](https://packagist.org/packages/nix-php/nixify)

Nix tool for PHP projects.

## Installation

You can install the package via composer:

``` bash
composer require ghostwriter/nixify
```

### Star ⭐️ this repo if you find it useful

You can also star (🌟) this repo to find it easier later.

## Usage

```php
vendor/bin/nixify
```

Generates a `default.nix` file for the project.

```php
vendor/bin/nixify make:default-nix
```

Generates a `flake.nix` file for the project.

```php
vendor/bin/nixify make:flake-nix
```

Generates a `shell.nix` file for the project.

```php
vendor/bin/nixify make:shell-nix
```

Locks Nix dependencies to latest versions.

```php
vendor/bin/nixify lock
```

Updates Nix files to the latest version.

```php
vendor/bin/nixify update
```

### Credits

- [Nathanael Esayeas](https://github.com/ghostwriter)
- [All Contributors](https://github.com/ghostwriter/nixify/contributors)

### Changelog

Please see [CHANGELOG.md](./CHANGELOG.md) for more information on what has changed recently.

### License

Please see [LICENSE](./LICENSE) for more information on the license that applies to this project.

### Security

Please see [SECURITY.md](./SECURITY.md) for more information on security disclosure process.
