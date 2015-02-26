# Medio [![SensioLabsInsight](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592/mini.png)](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592) [![Travis CI](https://travis-ci.org/gnugat/medio.png)](https://travis-ci.org/gnugat/medio)

Medio allows you to describe the code you want to generate using Models:

```php
$file = new File('src/Gnugat/Medio/MyService.php', Object::make('Gnugat\Medio\MyService')
    ->addProperty(new Property('createdAt'))
    ->addProperty(new Property('filename'))

    ->addMethod(Method::make('__construct')
        ->addArgument('DateTime', 'createdAt')
        ->addArgument('string', 'filename')
    )
);
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

    /**
     * @param \DateTime $createdAt
     * @param string    $filename
     */
    public function __construct(\DateTime $createdAt, $filename)
    {
    }
}
```

## Installation

Use [Composer](https://getcomposer.org/download) to install Medio in your project:

    composer require gnugat/medio:~1.0@alpha

> **Note**: Medio is currently slightly unstable. Some BC break might happen, but we try to make those rare.

In order to generate the code, you'll need to create an instance of `PrettyPrinter`:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\PrettyPrinter;

$loader = new \Twig_Loader_Filesystem(__DIR__.'/vendor/gnugat/medio/templates');
$twig = new \Twig_Environment($loader);

$prettyPrinter = new PrettyPrinter($twig);
```

> **Note**: The actual generation logic is hold by [Twig templates](http://twig.sensiolabs.org/).
> If the coding style provided doesn't appeal to you, you can overwrite those templates easily.

## Further documentation

Discover more by reading the docs:

* [Introduction](doc/01-introduction.md)
* [Installation](doc/02-installation.md)
* [Usage](doc/03-usage.md)
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

1. alpha: generate as much code as possible
2. beta: generate as much PHPdoc as possible
3. release candidate: read as much code as possible (using [nikic](http://nikic.github.io/aboutMe.html)'s [PHP-Parser](https://github.com/nikic/PHP-Parser))
4. stable release: Medio is able to read a file and to write it again without losing any information
