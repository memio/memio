# Vocabulary

Medio uses a highly opiniated vocabulary. Please find below its definitions:

* [Dependency](#dependency)
* [Method](#method)
* [Property](#property)

## Dependency

An object used by the current one. It is passed as a constructor argument and
stored as a [property](#property):

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
