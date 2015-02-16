# Model

In order to generate code, you must build some models. Here's all you need to
know about them.

![UML class diagram: ArgumentCollection has Argument which has Type](http://yuml.me/a5124cb7)

* [Argument](#argument)
* [ArgumentCollection](#argumentcollection)
* [Method](#method)
* [MethodPhpdoc](#methodphpdoc)
* [MethodCollection](#methodcollection)
* [Property](#property)
* [PropertyCollection](#propertycollection)
* [Constant](#constant)
* [ConstantCollection](#constantcollection)
* [File](#file)
* [License](#license)

See also [next readings](#next-readings).

## Argument

A method's single argument. It has a `Type` and a name:

```php
<?php

namespace Gnugat\Medio\Model;

class Argument
{
    public function __construct(Type $type, $name);
    public static function make(Type $type, $name);
}
```

The `Type` model is responsible of knowing if the argument can be type hinted:

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

## ArgumentCollection

Methods can have 0 to many arguments, this model takes care of managing those:

```php
<?php

namespace Gnugat\Medio\Model;

class ArgumentCollection
{
    public static function make();
    public function add(Argument $argument);
}
```

> **Note**: ArgumentCollection will rename added arguments in case of name collision,
> by suffixing them with a number.

## Method

By default methods are simple public ones (not static/final/abstract), with a name
and 0 to many arguments:

```php
<?php

namespace Gnugat\Medio\Model;

class Method
{
    public function __construct($name);
    public static function make($name);
    public function addArgument(Argument $argument);
}
```

## MethodPhpdoc

A Method can be documented using PHPdoc. This model takes care of it for you:

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

A File can have 0 to many methods this model takes care of managing those:

```php
<?php

namespace Gnugat\Medio\Model;

class MethodCollection
{
    public static function make();
    public function add(Method $method);
}
```

> **Note**: MethodCollection throws an `InvalidArgumentException` when the given
> method has the same name as one of the existing ones.

## Property

By default properties are always simple private ones (not static, no default value):

```php
<?php

namespace Gnugat\Medio\Model;

class Property
{
    public function __construct($name);
    public static function make($name);
}
```

## PropertyCollection

A File can have 0 to many properties, this model takes care of managing those:

```php
<?php

namespace Gnugat\Medio\Model;

class PropertyCollection
{
    public static function make();
    public function add(Property $property);
}
```

> **Note**: PropertyCollection throws an `InvalidArgumentException` when the
> given property has the same name as one of the existing ones.

## Constant

This is a class constant:

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

A File can have 0 to many constants, this model takes care of managing those:

```php
<?php

namespace Gnugat\Medio\Model;

class ConstantCollection
{
    public static function make();
    public function add(Constant $cosntant);
}
```

> **Note**: ConstantCollection throws an `InvalidArgumentException` when the
> given cosntant has the same name as one of the existing ones.

## File

This is the top most model, it contains everything:

```php
<?php

namespace Gnugat\Medio\Model;

class File
{
    public function __construct($filename);
    public static function make($filename);
    public function addProperty(Property $property);
    public function addMethod(Method $method);
}
```

> **Note**: It takes care of transforming the filename into namespace/classname
> for you.

## License

File can start with a license header. This "meta data" model takes care of it:

```php
<?php

namespace Gnugat\Medio\Model\MetaData;

class License
{
    public function __construct($filename);
    public static function make($filename);
    public function addProperty(Property $property);
    public function addMethod(Method $method);
}
```

## Next readings

* [Templates](02-templates.md)
* [Examples](03-examples.md)
