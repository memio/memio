# Tutorial

Medio provides a way to describe classes, properties, methods, etc using Models.
Here's a cheat sheet of those:

![UML class diagram](http://yuml.me/119b08be)

In this tutorial, we'll see how to:

1. Generating a chunk of code (e.g. a single argument)
2. Generating a standalone collection (e.g. many arguments)
3. Generating a collection in a Model (e.g. method's arguments)
4. Example: phpspec's method generation
5. PSR-2 and multiline arguments
6. Visibility, staticness, virtual, etc...
7. Class and Interface

## 1. Generating a chunk of code (e.g. a single argument)

The code sample in the [README](../README.md) deomnstrates how to generate a complete file.
But it is also possible to only generate a chunk of code, like a method's argument.

We can describe it by providing the type and the name:

```php
use Gnugat\Medio\Model\Argument;

$argument = new Argument('string', 'filename');

echo $prettyPrinter->generateCode($argument);
```

> **Note**: the following types are accepted: string, bool, int, double, callable, resource, array, null, mixed.
> If something else is given, Medio will consider it as an object.

This should print the following:

```php
$filename
```

Medio is able to automatically type hint an argument, when necessary:

```php
$argument = new Argument('DateTime', 'createdAt');

echo $prettyPrinter->generateCode($argument);
```

This will result in:

```php
\DateTime $createdAt
```

> **Note**: The following types will trigger the type hint: object, array and callable (only for PHP >= 5.4).
> For now object type hints are their fully qualified name (full namespace + class name), but this can change in the future.

## 2. Generating a standalone collection (e.g. many arguments)

An argument on its own is not very usefull, usually methods have a collection of arguments (0 to many).
This can be done by using arrays:

```php
$arguments = array(
    new Argument('Symfony\Component\HttpFoundation\Request', 'request'),
    new Argument('int', 'type'),
    new Argument('bool', 'catch'),
);

echo $prettyPrinter->generateCode($arguments);
```

With this we'll be able to see in our console:

```php
\Symfony\Component\HttpFoundation\Request $request, $type, $catch
```

The concept of collection is used for the following models:

* a method's `Arguments`
* a class/interface's `Constants`
* a class/interface's parents `Contracts`
* a file's `FullyQualifiedNames` (use statements)
* a class/interface's `Methods`
* a class's `Properties`

## 3. Generating a collection in a Model (e.g. method's arguments)

As explained above, a `Method` can have a collection of `Arguments` (0 to many).
In order to describe this method, we don't need to prepare an array before hand:

```php
use Gnugat\Medio\Model\Method;

$method = Method::make('handle')
    ->addArgument(new Argument('Symfony\Component\HttpFoundation\Request', 'request'))
    ->addArgument(new Argument('int', 'type'))
    ->addArgument(new Argument('bool', 'catch'))
;

echo $prettyPrinter->generateCode($method);
```

> **Note**: All models can either be instanciated using `new` or the static method `make`.
> The second option enable "fluent interface" (chaining method calls) for PHP < 5.6 (from this version you can use `(new Model)->method()`).

Here's the result:

```php
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param int                                       $type
     * @param bool                                      $catch
     */
    public function handle(\Symfony\Component\HttpFoundation\Request $request, $type, $catch)
    {
    }
```

## 4. Example: phpspec's method generation

Let's take the [phpspec](https://phpspec.net) example: when running your tests, it
is able to generate missing methods. If it were using Medio, it would use the following
snippet:

```php
// Those are the parameters phpspec gathers from your tests
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

// To make this example easier directly display the generated code
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

## 5. PSR-2 and multiline arguments

The [PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) advises us to avoid
lines longer than 120 characters.
Medio takes care of this when generating a method's arguments by checking the length:
if it's going to be too long it'll put each arguments on their own line.

Here's a code sample:

```php
$method = new Method('it_is_a_very_long_method');
for ($i = 1; $i < 8; $i++) {
    $method->addArgument(new Argument('mixed', 'argument'.$i));
}

echo $prettyPrinter->generateCode($method);
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
    )
    {
    }
```

## 6. Visibility, staticness, virtual, etc...

Medio assumes a few things by default:

* properties are private, not static, not abstract
* methods are public, not static, not abstract, not final
* classes are not final

This can be customized:

```php
$object = Object::make()
    ->makeFinal()  // can be cancelled with removeFinal()

$property = Property::make('myProperty')
    ->makePublic() // also available: makeProtected() and makePrivate()
    ->makeStatic() // can be cancelled with removeStatic()
;

$method = Method::make('myMethod')
    ->makePrivate() // also available: makeProtected(), makePublic() and removeVisibility()
    ->makeStatic() // can be cancelled with removeStatic()
    ->makeFinal() // can be cancelled with removeFinal()
```

## 7. Class and Interface

In PHP, `class` and `interface` are two reserved keywords. In order to be able to
have Models describing those, Medio provides respectively `Object` and `Contract`.

Here's an example of interface generation:

```php
use Gnugat\Medio\Model\Contract;

$contract =
```
