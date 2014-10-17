# Vocabulary

Medio uses a highly opiniated vocabulary. Please find below its definitions:

* [Argument](#argument)
    * [Inline arguments](#inline-arguments)
    * [Multiline arguments](#multiline-arguments)
* [Class](#class)
    * [Class opening](#class-opening)
    * [Class ending](#class-ending)
* [Constant](#constant)
* [Dependency](#dependency)
* [Method](#method)
* [Multiline method argument]()
* [Property](#property)

## Argument

A variable passed to a [method](#method):

```php
<?php

class Object
{
    public function method($argument)
    {
    }
}
```

### Inline arguments

When the total length of a [method](#method) is inferior to 80 characters:

```php
<?php

class Object
{
    public function inlineMethodInferiorToEightyCharacters($firstArgument)
    {
    }
}
```

### Multiline arguments

When the total length of a [method](#method) is strictly superior to 80 characters:

```php
<?php

class Object
{
    public function inlineMethodSuperiortoEightyCharacters(
        $firstArgument,
        $secondArgument
    )
    {
    }
}
```

## Class

An object following these rules:

* inline
* only one per file
* has an empty line before it
* has an empty line after it
* CamelCase (first letter of word in uppercase, the rest in lowercase)

```php
<?php

class Object
{
}
```

### Class opening

The opening braces of a class. It should be on its own line, not indented.

### Class ending

The closing braces of a class. It should be on its own line, not indented.

## Constant

A [class](#class) constant which follows these rules:

* indented by 4 spaces
* inline
* no comment
* the first one is immediately after the [class](#class) opening
* the second one is immediately after the first one, without empty lines
* an empty line separates it from other instruction, except for the [class](#class) ending
* UPPER_SNAKE_CASE (upper case, words separated by underscores)

```php
<?php

class Object
{
    const MY_CONSTANT = 42;
    const ANOTHER_ONE_BITE_THE_DUST = 23;
}

class Object
{
    const DEATH_ON_TWO_LEGS = 1337;

    private $property;
}
```

## Dependency

An object used by the current one. It is passed as a constructor
[argument](#argument) and stored as a [property](#property):

```php
<?php

class Object
{
    private $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }
}
```

## Method

An object's public non-static function:

```php
<?php

class Object
{
    public function method()
    {
    }
}
```

## Property

An object's private attribute:

```php
<?php

class Object
{
    private $property;
}
```
