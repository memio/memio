# Cheat Sheet

Here you will find prototypes of all classes and methods that are part of the public API:

* [PrettyPrinter](#prettyprinter)
* [Type](#type)
* [Argument](#argument)
* [ArgumentCollection](#argumentcollection)
* [Method](#method)
* [MethodPhpdoc](#methodphpdoc)
* [MethodCollection](#methodcollection)
* [Property](#property)
* [PropertyCollection](#propertycollection)
* [Constant](#constant)
* [ConstantCollection](#constantcollection)
* [Import](#import)
* [ImportCollection](#importcollection)
* [File](#file)
* [License](#license)

See also [next readings](#next-readings).

## PrettyPrinter

```php
<?php

namespace Gnugat\Medio;

class PrettyPrinter
{
    public function __construct(Twig_Environment $twig);
    public function generateCode($model, array $parameters = array());
}
```

## Type

```php
<?php

namespace Gnugat\Medio\Model;

class Type
{
    public function __construct($name);
    public static function make($name);

    public function getName();
    public function isObject();
}
```

> **Note**: a type is considered as being an object if the given name is
> different than `string`, `bool`, `int`, `double`, `callable`, `resource`,
> `array`, `null`, `mixed`.

## Argument

```php
<?php

namespace Gnugat\Medio\Model;

class Argument
{
    public function __construct(Type $type, $name);
    public static function make(Type $type, $name);
}
```

## ArgumentCollection

```php
<?php

namespace Gnugat\Medio\Model;

class ArgumentCollection
{
    public static function make();
    public function add(Argument $argument);
}
```

## Method

```php
<?php

namespace Gnugat\Medio\Model;

class Method
{
    public function __construct($name);
    public static function make($name);

    public function addArgument(Argument $argument);

    public function setBody($body);

    public function makeStatic();
    public function removeStatic();

    public function makePrivate();
    public function makeProtected();
    public function makePublic();
    public function removeVisibility();
}
```

## MethodPhpdoc

```php
<?php

namespace Gnugat\Medio\Model;

class MethodPhpdoc
{
    public function __construct(Method $method);
    public static function make(Method $method);
}
```

## MethodCollection

```php
<?php

namespace Gnugat\Medio\Model;

class MethodCollection
{
    public static function make();
    public function add(Method $method);
}
```

## Property

```php
<?php

namespace Gnugat\Medio\Model;

class Property
{
    public function __construct($name);
    public static function make($name);

    public function makeStatic();
    public function removeStatic();

    public function makePrivate();
    public function makeProtected();
    public function makePublic();
}
```

## PropertyCollection

```php
<?php

namespace Gnugat\Medio\Model;

class PropertyCollection
{
    public static function make();
    public function add(Property $property);
}
```

## Constant

```php
<?php

namespace Gnugat\Medio\Model;

class Constant
{
    public function __construct($name, $value);
    public static function make($name, $value);
}
```

## ConstantCollection

```php
<?php

namespace Gnugat\Medio\Model;

class ConstantCollection
{
    public static function make();
    public function add(Constant $cosntant);
}
```

## Import

A use statement:

```php
<?php

namespace Gnugat\Medio\Model;

class Import
{
    public function __construct($fqcn);
    public static function make($fqcn);
    public function setAlias($alias);
    public function removeAlias();
}
```

## ImportCollection

```php
<?php

namespace Gnugat\Medio\Model;

class ImportCollection
{
    public static function make();
    public function add(Import $import);
}
```

## File

```php
<?php

namespace Gnugat\Medio\Model;

class File
{
    public function __construct($filename);
    public static function make($filename);

    public function addImport(Import $import);
    public function addConstant(Constant $constant);
    public function addProperty(Property $property);
    public function addMethod(Method $method);
}
```

> **Note**: It takes care of transforming the filename into namespace/classname
> for you.

## License

```php
<?php

namespace Gnugat\Medio\Model;

class License
{
    public function __construct($projectName, $authorName, $authorEmail);
    public static function make($projectName, $authorName, $authorEmail);
}
```

## Next readings

* [Extending](05-extending.md)

Previous pages:

* [Usage](03-usage.md)
* [Installation](02-installation.md)
* [Introduction](01-introduction.md)
* [README](../README.md)
