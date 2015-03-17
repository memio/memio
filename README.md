# Medio [![SensioLabsInsight](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592/mini.png)](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592) [![Travis CI](https://travis-ci.org/gnugat/medio.png)](https://travis-ci.org/gnugat/medio)

Medio allows you to describe the code you want to generate using Models:

```php
$file = File::make('src/Gnugat/Medio/MyService.php')
    ->setStructure(Object::make('Gnugat\Medio\MyService')
        ->addProperty(new Property('createdAt'))
        ->addProperty(new Property('filename'))

        ->addMethod(Method::make('__construct')
            ->addArgument('DateTime', 'createdAt')
            ->addArgument('string', 'filename')
        )
    )
;
```

These Models can be given to a `PrettyPrinter`:

```php
echo $prettyPrinter->generateCode($file);
```

And as simply as that, you get the corresponding generated code:

```
<?php

namespace Gnugat\Medio;

class MyClass
{
    private $createdAt;

    private $filename;

    public function __construct(DateTime $createdAt, $filename)
    {
    }
}
```

## Installation

Use [Composer](https://getcomposer.org/download) to install Medio in your project:

    composer require gnugat/medio:~1.0@beta

> **Note**: Medio is currently slightly unstable. Some BC break might happen, but we try to make those rare.

In order to generate the code, you'll need to create an instance of `PrettyPrinter`:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\Config\Path;
use Gnugat\Medio\PrettyPrinter;

$loader = new \Twig_Loader_Filesystem(Path::templates());
$twig = new \Twig_Environment($loader);

$prettyPrinter = new PrettyPrinter($twig);
```

> **Note**: The actual generation logic is hold by [Twig templates](http://twig.sensiolabs.org/).
> If the coding style provided doesn't appeal to you, you can overwrite those templates easily.

## Further documentation

Discover more by reading the docs:

* [Model Tutorial](doc/01-model-tutorial.md)
* [PHPdoc Tutorial](doc/02-phpdoc-tutorial.md)
* [Examples](doc/03-examples.md)
* [Extending](doc/04-extending.md)

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/medio/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)

## Roadmap

* validator and constraint (e.g. final class cannot have abstract methods)
* parsing existing code (using [nikic](http://nikic.github.io/aboutMe.html)'s [PHP-Parser](https://github.com/nikic/PHP-Parser))
* commands (e.g. injecting dependency)
* TemplateEngine interface, to allow the choice between Twig and basic PHP templating
