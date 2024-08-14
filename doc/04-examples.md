# Examples

Tests are used as living usage examples as well as regression checks.

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
$this->assertSame('string $filename', $generatedCode);
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
* [Packages](06-packages.md)

Previous pages:

* [Validation Tutorial](03-validation-tutorial.md)
* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
