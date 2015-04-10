# Examples

Tests are used as living usage examples as well as regression checks.

## Specifications

> **TL;DR**: run `./vendor/bin/phpspec run --format=pretty` to list the behavior of each classes.

Memio uses [phpspec](http://www.phpspec.net/), a framework that forces us to write
documentative tests. Those are called specifications and can be found in `spec`.

Let's have a look at `MethodCannotBeBothAbstractAndStatic`'s specification:

```php
<?php

namespace spec\Memio\Memio\Validator\Constraint;

use Memio\Model\Method;
use PhpSpec\ObjectBehavior;

class MethodCannotBeBothAbstractAndStaticSpec extends ObjectBehavior
{
    function it_is_a_constraint()
    {
        $this->shouldImplement('Memio\Memio\Validator\Constraint');
    }

    function it_is_fine_with_non_static_abstract_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isStatic()->willReturn(false);

        $this->validate($method)->shouldHaveType('Memio\Memio\Validator\Violation\NoneViolation');
    }

    function it_is_not_fine_with_abstract_and_static_methods(Method $method)
    {
        $method->isAbstract()->willReturn(true);
        $method->isStatic()->willReturn(true);
        $method->getName()->willReturn('__construct');

        $this->validate($method)->shouldHaveType('Memio\Memio\Validator\Violation\SomeViolation');
    }
}
```

As we can see:

* Our System Under Test ([SUT](http://en.wikipedia.org/wiki/System_under_test), the tested class) is specified in as much edge cases as possible
* tests methods name describes the behavior (rather than the tested method name like `testValidate`)
* tests depict all interractions involved with Collaborators (classes used by our SUT)

The suite can be run using the following `./vendor/bin/phpsepc run`, and by adding the
`--format=pretty` option we can get a readable list of test methods per class.

## Code generation examples

> **TL;DR**: `examples/*Test.php` contains examples of Model construction,
> `examples/fixtures/*Test/test*.txt` contains expected generated code.

In the `examples` directory we can find tests written with [PHPUnit](https://phpunit.de/),
they have been designed to also be used as living examples.

Each test method is structured in a similar way:

```php
// Describing the model
$argument = new Argument('string', 'filename');

// Generating the code
$generatedCode = $this->prettyPrinter->generateCode($argument);

// Checking it against what's expected
$this->assertSame('$filename', $generatedCode);
```

Sometimes the expected code is spanned on many lines:

```php
$method = new Method('__construct');

$generatedCode = $this->prettyPrinter->generateCode($method);

$this->assertExpectedCode($generatedCode);
```

The `assertExpectedCode` method uses the current Test Class and method names to
guess the location of a fixture file, where the expected code is.

Those can be found in `examples/fixtures/<TestClassName>/<testMethodName>.txt`.

> **Note**: Fixture files always have an extra line, which is trimmed before the
> actual assertion.

When changes are applied to Memio, the following command is executed to make
sure no regressions have been introduced:

    phpunit

## Next readings

* [Templates](05-templates.md)

Previous pages:

* [Validation Tutorial](03-validation-tutorial.md)
* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
