# Vocabulary

Medio uses a highly opiniated vocabulary. Please find below its definitions:

* [Argument](#argument)
    * [Inline arguments](#inline-arguments)
    * [Multiline arguments](#multiline-arguments)
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
