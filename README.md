# Medio

A [highly opiniated](#high-opinions) library, helping you to manipulate code.

## Cheat Sheet (APIs)

```php
<?php

namespace Gnugat\Medio;

use Gnugat\Redaktilo\Search\PatternNotFoundException;

class Selector
{
    // @throw PatternNotFoundException
    public function methodDeclaration(Text $text, $name, $visibility = 'public');
}

```

## High opinions

Valid code should follow these rules:

* one indentation = 4 spaces
* brackets are on their own line

Example:

```php
<?php

class Object
{
    public function publicMethod()
    {
    }

    function methodWithoutVisibility()
    {
    }
}
```

## Demonstration code

The `Application` and `Container` classes are provided for demonstration purpose
(used in `medio.php`). Please don't use them in production.
