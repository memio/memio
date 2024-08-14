# Model Tutorial

Memio provides a way to describe Models (classes, properties, methods, etc).
Here's a cheat sheet of those:

![UML class diagram](http://yuml.me/b124406d)

In this tutorial, we'll see how to:

1. Generate a chunk of code (e.g. a single argument)
2. Generate a standalone collection (e.g. many arguments)
3. Generate a collection in a Model (e.g. method's arguments)
4. Example: phpspec's method generation
5. Generate multiline arguments (e.g. PSR-2 compliant)
6. Generate visibility, staticness, virtualness, etc...
7. Generate Constant and default values
8. Generate Class and Interface
9. Generate File

## 1. Generating a chunk of code (e.g. a single argument)

The code sample in the [README](../README.md) demonstrates how to generate a complete file.
But it is also possible to only generate a chunk of code, like a method's argument.

We can describe it by providing the type and the name:

```php
use Memio\Model\Argument;

$filename = new Argument('string', 'filename');

echo $prettyPrinter->generateCode($filename);
```

> **Note**: the following types are accepted: string, bool, int, double, callable, resource, array, null, mixed.
> If something else is given, Memio will consider it as an object.

This should print the following:

```php
string $filename
```

Memio is able to automatically type hint an argument, when necessary:

```php
$createdAt = new Argument('DateTime', 'createdAt');

echo $prettyPrinter->generateCode($createdAt);
```

This will result in:

```php
DateTime $createdAt
```

> **Note**: The following types are type hinted: object, array and callable
> (only if Memio is ran using PHP >= 5.4).

## 2. Generating a standalone collection (e.g. many arguments)

An argument on its own is not very usefull, usually methods have a collection of arguments (0 to many).
This can be done by using arrays:

```php
$handleArguments = array(
    new Argument('Symfony\Component\HttpFoundation\Request', 'request'),
    (new Argument('int', 'type'))
        ->setDefaultValue('self::MASTER_REQUEST')
    ,
    (new Argument('bool', 'catch'))
        ->setDefaultValue('true')
    ,
);

echo $prettyPrinter->generateCode($handleArguments);
```

With this we'll be able to see in our console:

```php
Request $request, $type = self::MASTER_REQUEST, $catch = true
```

> **Note**: The following Models can be in a collection:
> `Argument`, `Constant`, `Contract` (class/interface parents), `FullyQualifiedName` (use statements), `Method` and `Property`.

## 3. Generating a collection in a Model (e.g. method's arguments)

As explained above, a `Method` can have a collection of `Arguments` (0 to many).
In order to describe this method, we don't need to prepare an array beforehand:

```php
use Memio\Model\Method;

$handle = (new Method('handle'))
    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))
    ->addArgument((new Argument('int', 'type'))
        ->setDefaultValue('self::MASTER_REQUEST')
    )
    ->addArgument((new Argument('bool', 'catch'))
        ->setDefaultValue('true')
    )
;

echo $prettyPrinter->generateCode($handle);
```

Here's the result:

```php
    public function handle(
        Request $request,
        int $type = self::MASTER_REQUEST,
        bool $catch = true
    ) {
    }
```

## 4. Example: phpspec's method generation

When running the test suite, [phpspec](https://phpspec.net) generates missing methods
in your code (amongst many other nice things). To put into practice what we've
seen so far, we're going to recreate this feature using Memio:

```php
// Those are the parameters phpspec gathers from the tests
$methodName = '__construct';
$arguments = array(new ArrayObject(), 'Nobody expects the spanish inquisition!');

// Using them we can describe the method to generate
$method = new Method($methodName);
$index = 1;
foreach ($arguments as $argument) {
    $type = is_object($argument) ? get_class($argument) : gettype($argument);
    $argumentName = 'argument'.$index++;
    $method->addArgument(new Argument($type, $argumentName));
}

// Let's display the generated code in the console
echo $prettyPrinter->generateCode($method);
```

This would output:

```
    public function __construct(ArrayObject $argument1, string $argument2)
    {
    }
```

## 5. Generating multiline arguments (e.g. PSR-2 compliant)

The [PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) advises us to avoid
lines longer than 120 characters.
Memio takes care of this when generating a method's arguments by checking the length:
if it's going to be longer than 80 characters it'll put each arguments on their own line.

Here's a code sample:

```php
$specification = new Method('it_is_a_very_long_method');
for ($i = 1; $i <= 7; $i++) {
    $specification->addArgument(new Argument('mixed', 'argument'.$i));
}

echo $prettyPrinter->generateCode($specification);
```

This will output:

```php
    public function it_is_a_very_long_method(
        $argument1,
        $argument2,
        $argument3,
        $argument4,
        $argument5,
        $argument6,
        $argument7
    ) {
    }
```

## 6. Generating visibility, staticness, virtualness, etc...

Memio assumes a few things by default:

* properties are private, not static, not abstract
* methods are public, not static, not abstract, not final
* classes are not final, not abstract

This can be customized:

```php
$superObject = (new Object())
    ->makeAbstract() // can be cancelled with removeAbstract()
    ->makeFinal() // can be cancelled with removeFinal()
;

$publicStaticProperty = (new Property('myProperty'))
    ->makePublic() // also available: makeProtected() and makePrivate()
    ->makeStatic() // can be cancelled with removeStatic()
;

$superMethod = (new Method('myMethod'))
    ->makeAbstract()  // can be cancelled with removeAbstract()
    ->makeFinal() // can be cancelled with removeFinal()
    ->makePrivate() // also available: makeProtected(), makePublic() and removeVisibility()
    ->makeStatic() // can be cancelled with removeStatic()
;
```

## 7. Generating Constant and default values

A constant or a default value can be many things: a string encapsulated between single or double quotes,
an integer, null... Since PHP 5.6 it can even be a numeric or string literal (e.g. `__DIR__.'/path'`).

To allow all of those in the simplest possible way, Memio let us write the raw value that will be
printed:

```php
use Memio\Model\Constant;

$firstConstant = new Constant('FIRST_CONSTANT', '"string in double quotes"');
$secondConstant = new Constant('SECOND_CONSTANT', 'null');

echo $prettyPrinter->generateCode($firstConstant);
echo $prettyPrinter->generateCode($secondConstant);
```

This will output:

```php
    const FIRST_CONSTANT = "string in double quotes";
    const SECOND_CONSTANT = null;
```

## 8. Generating Class and Interface

In PHP, `class` and `interface` are two reserved keywords. In order to be able to
have Models describing those, Memio provides respectively `Object` and `Contract`.

Here's an example of interface generation:

```php
use Memio\Model\Contract;

$myMethod = new Method('myMethod')
    ->addArgument('mixed', 'myArgument')
);
$myContract = (new Contract('Vendor\Project\MyInterface'))
    ->extend(new Contract('Vendor\Project\MyParentInterface'))
    ->addConstant(new Constant('MY_CONSTANT', '42'))
    ->addMethod($myMethod)
;

echo $prettyPrinter->generateCode($myContract);
```

Will output:

```php
interface MyInterface extends MyParentInterface
{
    const MY_CONSTANT = 42;

    public function myMethod($myArgument);
}
```

Objects can extend only one parent, but can implement many interfaces. Contracts
can extend many interfaces.

## 9. Generating File

Finally, we can generate a whole `File`:

```php
$myFile = (new File('src/Vendor/Project/MyObject'))
    ->addFullyQualifiedName($myContract->getFullyQualifiedName())
    ->setStructure((new Object('Vendor\Project\MyObject'))
        ->implement($myContract)
        ->addMethod($myMethod)
    )
;

$prettyPrinter->generateCode($myFile);
```

This will output:

```php
<?php

namespace Vendor\Project;

use Vendor\Project\MyInterface;

class MyObject implements MyInterface
{
    public function myMethod($myArgument)
    {
    }
}
```

## Next readings

* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Validation Tutorial](03-validation-tutorial.md)
* [Examples](04-examples.md)
* [Templates](05-templates.md)
* [Packages](06-packages.md)

Previous pages:

* [README](../README.md)
