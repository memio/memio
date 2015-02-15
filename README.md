# Medio

A code generation library, which uses [Twig templates](http://twig.sensiolabs.org/).

> **Note**: Templates provided out of the box are highly opinionated, but you can
> customize them.

In order to generate a chunk of code, you need to describe it through the
construction of "models". Once done, you can give the top most model to the
`PrettyPrinter` service: it will find the appropriate [Twig template](http://twig.sensiolabs.org/)
and do the actual generation.

Want to see it in action? Here's an example:

```php
$file = File::make('/src/Gnugat/Medio/MyClass.php')
    ->addConstant(new Constant('FIRST_CONSTANT', '0'))
    ->addConstant(new Constant('SECOND_CONSTANT', "'meh'"))

    ->addProperty(new Property('firstProperty'))
    ->addProperty(new Property('secondProperty'))

    ->addMethod(Method::make('firstMethod')
        ->addArgument(new Argument(new Type('DateTime'), 'firstArgument'))
        ->addArgument(new Argument(new Type('array'), 'secondArgument'))
        ->addArgument(new Argument(new Type('string'), 'thirdArgument'))
    )
    ->addMethod(new Method('secondMethod'))
;

echo $prettyPrinter->generateCode($file);
```

This should print the following generated code:

```
<?php

namespace Gnugat\Medio;

class MyClass
{
    const FIRST_CONSTANT = 0;
    const SECOND_CONSTANT = 'meh';

    private $firstProperty;

    private $secondProperty;

    /**
     * @param \DateTime $firstArgument
     * @param array     $secondArgument
     * @param string    $thirdArgument
     */
    public function firstMethod(\DateTime $firstArgument, array $secondArgument, $thirdArgument)
    {
    }

    public function secondMethod()
    {
    }
}


```

> **Note**: each arguments would have been put on their own line if the inline
> alternative was longer than 120 characters.

![Logo: an elephant, a tree and some twigs](https://raw.githubusercontent.com/gnugat/medio/master/logo.jpg)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592/mini.png)](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592)
[![Travis CI](https://travis-ci.org/gnugat/medio.png)](https://travis-ci.org/gnugat/medio)

## Installation

Use [Composer](https://getcomposer.org/download):

    composer require gnugat/medio:~1.0@alpha

## Roadmap

* more models (use statements, etc)
* meta data management (PHPdoc `@return`, PHPdoc `@var`, license header, etc)
* building models from existing code (using [nikic](http://nikic.github.io/aboutMe.html)'s [PHP-Parser](https://github.com/nikic/PHP-Parser))
* commands (inject dependency: add use statement, property, constructor argument, etc)

## Further documentation

Discover more by reading the docs:

* [Model](doc/01-model.md)
* [Templates](doc/02-templates.md)
* [Examples](doc/03-examples.md)

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/medio/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
