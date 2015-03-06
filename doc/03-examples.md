# Examples

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

Sometimes the expected code is spanned on many lines, in that case we will find
`$this->assertExpectedCode($generatedCode);`.
This assertion uses the current Test Class and method names to guess the location of a fixture file,
where the expected code is.

Those can be found in `examples/fixtures/<TestClassName>/<testMethodName>.txt`.

> **Note**: Fixture files always have an extra line, which is trimmed before the actual assertion.

When changes are applied to Medio, the following command is executed to make sure no regressions
have been introduced:

    phpunit

## Next readings

* [Extending](04-extending.md)

Previous pages:

* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
