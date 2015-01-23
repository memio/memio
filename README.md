# Medio

A highly opiniated code generator library.

Currently provides only a way to generate arguments for a class method:

* objects, array and callable are typehinted
* can automatically name the arguments for you
* arguments are renamed to avoid collision, when necessary

## Installation

Use [Composer](https://getcomposer.org/download):

    composer require gnugat/medio:~0.3

## Usage

Let's say that we have an array of variables which represent a method's arguments:

```php
$arguments = array('string', new \ArrayObject(), function () {});
```

Here's a snippet which uses Medio:

```php
$argumentCollection = $variableArgumentCollectionFactory->make($variables);
echo $inlineArgumentCollectionPrinter->dump($argumentCollection);
```

It should print the following generated code:

```
$argument1, ArrayObject $arrayObject, callable $argument2
```

As you can see the arguments have been type hinted and the object has been named
after its type. The non object arguments have been named using a generic name
(`argument`), but name collision has been detected and they've been suffixed by
a number.

For more examples, see:

* [Creating a phpspec extension](./doc/example-phpspec-extension.md)

## Details

Medio provides a modelisation of your code (in `Gnugat\Medio\Model`):

* a `Method` has an `ArgumentCollection`
* an `ArgumentCollection` can have 0 to many `Argument`, it also takes care of avoiding name collision
* an `Argument` has a type, a name and a way to tell if it's an object or not

Creating those models manually can be tedious, so factories are provided (in `Gnugat\Medio\Factory`):

* `TypeArgumentFactory` can create an `Argument` from a given type
* `VariableArgumentFactory` can create an `Argument` from a given variable (guesses the type)
* `VariableArgumentCollectionFactory` can create an `ArgumentCollection` from an array of variables

Once modelized, the code can be generated using "pretty printers" (in `Gnugat\Medio\PrettyPrinter`):

* `ArgumentPrinter` takes care of type hinting
* `InlineArgumentCollectionPrinter` makes an inline list of arguments

> **Note**: those "pretty printer" aren't "fidelity printers", they'll format the
> code based on highly opinions (they can be considered as "nice printers").
