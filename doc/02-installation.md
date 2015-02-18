# Installation

> **TL;DR**: `composer require gnugat/medio:~1.0@alpha`

Installing Medio in your application is pretty similar to other PHP projects:

1. [Composer: getting the sources](#composer-getting-the-sources)
2. [Puli: find the templates](#puli-find-the-templates)
3. [Building the services](#building-the-services)

See also [the next readings](#next-readings).

## Composer: getting the sources

Medio can be installed via [Composer](https://getcomposer.org/download):

    composer require gnugat/medio:~1.0@alpha

## Puli: find the templates

> **Important**: This step is totally optional.

You can find Twig templates in the `templates` directory. Instead of hardcoding
the path, you can use [Puli](https://docs.puli.io):

```php
<?php

require __DIR__.'/vendor/autoload.php';

$factoryClass = PULI_FACTORY_CLASS;
$factory = new $factoryClass();
$repository = $factory->createRepository();

$medioTemplatesPath = $repository->get('/gnugat/medio/templates')->getFilesystemPath();
```

> **Note**: Giving `/gnugat/medio/templates` to Puli's repository is safe, it
> will find for you the actual path in the vendor directory.

In order to do so, you need to install Puli's Composer plugin in your `composer.json`:

```
{
    "require": {
        "puli/composer-plugin": "~1.0@beta",
        "puli/discovery": "~1.0@beta",
        "puli/factory": "~1.0@beta",
        "puli/repository": "~1.0@beta",
        "puli/repository-manager": "~1.0@beta",
        "webmozart/glob": "~1.0@beta",
        "webmozart/json": "~1.0@beta",
        "webmozart/key-value-store": "~1.0@beta"
    }
}
```

> **Note**: This is a bit ugly, but when Puli 1.0.0@stable will be released you'll
> be able to simply do: `composer require puli/composer-plugin:~1.0`.

## Building the services

Medio provides a `PrettyPrinter` class which can be instanciated once and used
everywhere. Here's how to build it:

```php
// ...

use Gnugat\Medio\PrettyPrinter;
use Gnugat\Medio\TwigExtension\Phpdoc;
use Gnugat\Medio\TwigExtension\Whitespace;

$loader = \Twig_Loader_Filesystem($medioTemplatesPath);
$twig = new \Twig_Environment($loader);
$twig->addExtension(new Phpdoc());
$twig->addExtension(new Whitespace());

$prettyPrinter = new PrettyPrinter($twig);
```

> **Note**: You can use the Dependency Injection Container of your choice to build it for you.

## Next readings

* [Usage](03-usage.md)
* [Cheat Sheet](04-cheat-sheet.md)
* [Extending](05-extending.md)

Previous pages:

* [Introduction](01-introduction)
* [README](../README.md)
