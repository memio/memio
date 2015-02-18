# Usage

> **TL;DR**: `PrettyPrinter#generateCode($model, array $parameters = array())`

There's only two phase to follow when using Medio:

1. describing the code to generate by building the model
2. calling `PrettyPrinter`

You can find more information on how to concretely do that here:

1. [The main service: PrettyPrinter](#the-main-service-prettyprinter)
2. [Generating a small chunk of code](#generating-a-small-chunk-of-code)
3. [Generating a whole file](#generating-a-whole file)
4. [Refining models](#refining-models)
5. [More examples](#more-examples)

See also [the next readings](#next-readings).

## The main service: `PrettyPrinter`

Medio provides a single generator which holds no logic: `PrettyPrinter`.
Its sole responsibility is to execute the appropriate template (for this, it uses
the given model's type).

It can optionnaly take a second argument: an array of options to pass to the template.

In the next sections, we'll see actual examples.

## Generating a small chunk of code

When [phpspec](https://phpspec.net) finds in a specification a method which does not
exist, it can generate it for you. If it was using Medio, it would use the following
snippet:

```php
$methodName = '__construct';
$arguments = array(new ArrayObject(), 'Nobody expects the spanish inquisition!');

$method = new Method($methodName);
$index = 1;
foreach ($arguments as $argument) {
    $type = is_object($argument) ? get_class($argument) : gettype($argument);
    $argumentName = 'argument'.$index++;
    $method->addArgument(new Argument(new Type($type), $argumentName));
}

echo $prettyPrinter->generateCode($method);
```

This would output:

```
    /**
     * @param \ArrayObject $argument1
     * @param string       $argument2
     */
    public function __construct(\ArrayObject $argument1, $argument2)
    {
    }
```

> **Note**: Medio type hints arguments when possible (object, array, callable for PHP >= 5.4).
> It also generates the method's PHPdoc for arguments.

## Generating a whole file

Medio provides the following models:

![UML class diagram](http://yuml.me/213ff6db)

It assumes that projects are using PSR-0:

* a file contains only a class/interface/trait
* the path of the file reflects its namespace

With this the `File` model is able to generate the namespace and the classname,
by simply processing the path:

```php
$file = new File('src/Gnugat/Medio/MyClass.php');

echo $prettyPrinter->generateCode($file);
```

This will output:

```php
<?php

namespace Gnugat\Medio;

class MyClass
{
}
```

To generate a class with constants, properties and/or methods you just need to write:

```php
$file = File::make('src/Gnugat/Medio/MyClass.php')
    ->addConstant(new Constant('MY_CONSTANT', "'string value should be quoted'"))
    ->addProperty(new Property('myProperty'))
    ->addMethod(new Method('myMethod'))
;
```

> **Note**: You can use either `new Model()` or `Model::make()` to instantiate
> a model.
> The second choice lets you chain calls (this is also possible because setter
> methods all return `$this`).

## Refining models

Medio assumes a few things by default:

* properties are private
* methods are public

This can be customized:

```php
$property = Property::make('myProperty')
    ->makePublic() // you can also call makeProtected() or makePrivate()
    ->makeStatic() // you can cancel this by using removeStatic()
;

$method = Method::make('myMethod')
    ->makePrivate() // you can also call makeProtected(), makePublic() or removeVisibility()
    ->makeStatic() // you can cancel this by using removeStatic()
```

## More examples

Medio doesn't have traditional tests. It has executable examples!

Have a look in the `examples` directory, each file contains a feature with many
scenarii.

> **Note**: Here, the word feature is used instead of "PHPUnit Test Class", and
> the word scenario is used instead of "test method".
>
> Please ignore the `examples/PrettyPrinterTestCase.php` file (used to bootstrap tests).

Each scenario is composed of 3 kind of steps:

1. creation of the model
2. generation of the code, using the built model
3. comparison with expected code

The expected code can be quite lengthy, in those cases it's been put in a fixture
file. But don't panic! You can find them in the `examples/fixtures` directory, they are
put in a folder named after the feature, and then in a file named after the scenario.

To make sure each modification added to Medio doesn't break anything, those
examples are executed using [phpunit](http://phpunit.de).

## Next readings

* [Cheat Sheet](04-cheat-sheet.md)
* [Extending](05-extending.md)

Previous pages:

* [Installation](02-installation.md)
* [Introduction](01-introduction.md)
* [README](../README.md)
