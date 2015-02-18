# Introduction

> **TL;DR**: Describe the code to generate by building "Model" classes, then give
> them to the `PrettyPrinter` service. It uses Twig templates to render the code,
> you just need to replace those to customize the output.

Medio is a Code Generator, but before diving into how to use it we'll first see
the different kinds of code generators, their purposes and where Medio is:

1. [Pretty Printer](#pretty-printer)
2. [Model classes as input](#model-classes-as-input)
3. [Twig templates as output](#twig-templates-as-output)
4. [Possible usage](#possible-usage)

See also [the next readings](#next-readings).

## Pretty Printer

There's two big categories of generators: Fidelity ones and Pretty Printer ones.

When editing an existing file the Fidelity code generator will try to keep
everything as is, except for the things the developer asked to change of course.

> For instance a Coding Style Fixer might replace tabs with spaces, but those will
> be the only character changes in the file. Another example could be a Code Optimizer
> which removes a function call from a `for` declaration: everything that is not
> in the scope of the generator will stay untouched.

On the other hand Pretty Printers don't manipulate the file directly: they first
abstract it using an Abstract Syntax Tree (AST), then apply modifications and finally
dump the AST using its own coding style.

Medio is a Pretty Printer, which means that it has the following drawbacks:

* it has its own coding style
* it can only generate code that has been modelize

> For example in version 1.0.0-alpha10 Medio doesn't support properties PHPdoc:
> if you edit a source which had them, they will be lost when regenerating it.

In order to counter the first one, Medio uses templates to generate the code.
They can be extended, customized and adapted to fit any coding style.

The second one is taking care of by adding more models everyday.

> **Important**: Currently it is only possible to generate new code with Medio,
> it is still under heavy development and the use of [PHP Parser](github.com/nikic/php-parser) is planned.

## Model classes as input

Some code generators take a configuration file in input to describe the code to
generate (e.g. a XML file listing a class properties and methods). Others don't
even describe the code, they rather describe a behavior in a configuration file
and the generator has some kind of logic to guess what to generate.

Medio simply takes Model classes as input: those objects describe the structure
of a file (with the assumption that a file always contain a single class).

It has been designed to be a construction brick ready to be used by anyone.
The code generators mentioned above could use Medio:

1. parse the configuration file
2. modelize the code from it by building Medio's Model classes
3. generate the code using Medio's Pretty Printer

## Twig templates as output

In order to generate the output, some projects use Specialized Generators: each
Generator class supports a specific section (e.g. MethodGenerator can generate methods)
and contains its own generation logic. Those can be extended or overloaded to be
customized.

Medio rather uses templates, as mentioned above (more specifically it uses the
[Twig Template Engine](http://twig.sensiolabs.org/)). It has the advantage of
editing the output in its final form, givinga better visibility on what's going
to be actually generated.

## Possible usage

Code Generators can be used for the following purposes:

* bootstrap boilerplate code (e.g. property, argument and comments when injecting a dependency)
* caching for optimization purpose (e.g. Twig translates its templates into PHP code)
* translating a Domain Specific Language into code (see Intentional Programming)

## Next readings

* [Installation](02-installation.md)
* [Usage](03-usage.md)
* [Cheat Sheet](04-cheat-sheet.md)
* [Extending](05-extending.md)

Previous pages:

* [README](../README.md)
