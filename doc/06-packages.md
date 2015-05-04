# Packages

Memio is a collection of small packages:

* [memio/linter](http://github.com/memio/linter)
* [memio/model](http://github.com/memio/model)
* [memio/pretty-printer](http://github.com/memio/pretty-printer)
* [memio/twig-template-engine](http://github.com/memio/twig-template-engine)
* [memio/validator](http://github.com/memio/validator)

It allows the creation of custom code generator: we could create a new implementation
of `TemplateEngine` that uses [Blade](http://laravel.com/docs/5.0/templates),
and a set of `Constraints` that check that our `Models` comply to the
[object calisthenics rules](http://williamdurand.fr/2013/06/03/object-calisthenics/).

Here's a diagram showing how Memio packages are composed:

![Package diagram](http://yuml.me/8686d889)

The main repository, [memio/memio](http://github.com/memio/memio), is a standard
selection of those packages with some helpers to make their usage easy (e.g. the
`Build` class).

Previous pages:

* [Templates](05-templates.md)
* [Examples](04-examples.md)
* [Validation Tutorial](03-validation-tutorial.md)
* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
