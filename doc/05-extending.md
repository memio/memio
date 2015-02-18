# Extending

Medio uses [Twig templates](http://twig.sensiolabs.org/) to actualy generate the
code.

> Keep in mind that the templates provided out of the box are highly opinionated,
> but they can be extended / over wrote.

* [Overwriting templates](#overwriting-templates)
* [Conventions](#conventions)

See also [next readings](#next-readings).

## Overwriting templates

In order to change how a specific model is rendered, you need to:

1. create your own template
2. add the path to your templates to Twig's loader

Here's an example:

```php
$loader->addPath(__DIR__.'/my-templates');
```

## Conventions

A model's templates is named after its class name, in snake_case. It always takes
as its first argument the model (the variable is also named after the model's class anme in snake_case).

> For instance, `ArgumentCollection` should have a template named `argument_collection.twig`.
> The template should receive the model, in the `argument_collection` parameter.

"Sub-templates" should be prefixed with an underscore.

> For example: `_inline_argument_collection.twig`.

## Next readings

Previous pages:

* [Cheat Sheet](04-cheat-sheet.md)
* [Usage](03-usage.md)
* [Installation](02-installation.md)
* [Introduction](01-introduction.md)
* [README](../README.md)
