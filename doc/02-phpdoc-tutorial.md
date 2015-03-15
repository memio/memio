# PHPdoc Tutorial

Medio also provides a way to document the code with [PHPdoc](http://www.phpdoc.org/).

By default no PHPdoc is generated, this must be triggered by setting a PHPdoc object in the model.

![UML class diagram](http://yuml.me/88fc72e9)

In this tutorial, we'll see how to:

1. Generate a License header
2. Generate a Structure's PHPdoc
3. Generate a Property's PHPdoc
4. Generate a Method's PHPdoc

## 1. Generating the License header

`Files` can have a license header, which usually displays the name of the project,
the author's name and their emails:

```php
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Object;
use Gnugat\Medio\Model\Phpdoc\LicensePhpdoc;

$file = File::make('src/Gnugat/Medio/MyClass')
    ->setLicensePhpdoc(new LicensePhpdoc('MyProject', 'Me', 'me@example.com'))

    ->setStructure(new Object('Gnugat\Medio\MyClass'))
;

echo $prettyPrinter->generateCode($file);
```

This will output:

```php
<?php

/*
 * This file is part of the My Project project.
 *
 * (c) Me <me@example.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

class MyClass
{
}
```

## 2. Generating PHPdoc for a Structure

A `Structure` (an `Object` or a `Contract`) can have the following:

* a description
* a deprecation tag
* an API tag

Here's how to describe it:

```php
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\Phpdoc\ApiTag;
use Gnugat\Medio\Model\Phpdoc\Description;
use Gnugat\Medio\Model\Phpdoc\DeprecationTag;
use Gnugat\Medio\Model\Phpdoc\StructurePhpdoc;

$contract = Contract::make('Gnugat\Medio\MyInterface')
    ->setPhpdoc(StructurePhpdoc::make()
        ->setDescription(Description::make('This is the first line')
            ->addEmptyLine()
            ->addLine('This is the third line')
        )
        ->setDeprecationTag(new DeprecationTag()) // Has 2 optional arguments: version, and description
        ->setApiTag(new ApiTag('v2.0')) // The argument is optional
    )
;

echo $prettyPrinter->generateCode($contract);
```

This will produce:

```php
/**
 * This is the first line
 *
 * This is the third line
 *
 * @deprecated
 *
 * @api v2.0
 */
interface MyInterface
{
}
```

## 3. Generating PHPdoc for a Property

A `Property` can have a property tag:

```php
use Gnugat\Medio\Model\Property;
use Gnugat\Medio\Model\Phpdoc\PropertyPhpdoc;
use Gnugat\Medio\Model\Phpdoc\VariableTag;

$property = Property::make('myClass')
    ->setPhpdoc(PropertyPhpdoc::make()
        ->setVariableTag(new VariableTag('Gnugat\Medio\MyClass'))
    )
;

echo $prettyPrinter->generateCode($property);
```

This will generate:

```php
    /**
     * @var MyClass
     */
    private $myClass;
```

## 3. Generating PHPdoc for a Method

A `Method` can have the following:

* a description
* 0 to many parameter tags
* a deprecation tag
* an API tag

Here's how to describe it:

```php
use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Phpdoc\ApiTag;
use Gnugat\Medio\Model\Phpdoc\Description;
use Gnugat\Medio\Model\Phpdoc\DeprecationTag;
use Gnugat\Medio\Model\Phpdoc\MethodPhpdoc;
use Gnugat\Medio\Model\Phpdoc\ParameterTag;

$method = Method::make('__construct')
    ->setPhpdoc(MethodPhpdoc::make()
        ->setDescription(Description::make('This is the first line')
            ->addEmptyLine()
            ->addLine('This is the third line')
        )
        ->addParameterTag(new ParameterTag('string', 'filename'))
        ->addParameterTag(new ParameterTag('bool', 'isEnabled', 'Optional description'))
        ->setDeprecationTag(new DeprecationTag())
        ->setApiTag(new ApiTag('v2.0'))
    )

    ->addArgument(new Argument('string', 'filename'))
    ->addArgument(new Argument('bool', 'isEnabled'))
;

echo $prettyPrinter->generateCode($method);
```

This will produce:

```php
    /**
     * This is the first line
     *
     * This is the third line
     *
     * @param string $filename
     * @param bool   $isEnabled Optional description
     *
     * @deprecated
     *
     * @api v2.0
     */
    public function __construct($filename, $isEnabled)
    {
    }
```

> **Note**: Parameter names are aligned.

## Next readings

* [Examples](03-examples.md)
* [Extending](04-extending.md)

Previous pages:

* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
