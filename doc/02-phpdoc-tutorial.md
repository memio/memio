# PHPdoc Tutorial

Memio also provides a way to document the code with [PHPdoc](http://www.phpdoc.org/).

By default no PHPdoc is generated, this must be triggered by setting a PHPdoc object in the model.

![UML class diagram](http://yuml.me/b8570257)

In this tutorial, we'll see how to:

1. Generate a License header
2. Generate a Structure's PHPdoc
3. Generate a Property's PHPdoc
4. Generate a Method's PHPdoc

## 1. Generating the License header

`Files` can have a license header, which usually displays the name of the project,
the author's name and their emails:

```php
use Memio\Model\File;
use Memio\Model\Object;
use Memio\Model\Phpdoc\LicensePhpdoc;

$file = (new File('src/Vendor/Project/MyClass'))
    ->setLicensePhpdoc(new LicensePhpdoc('MyProject', 'Me', 'me@example.com'))

    ->setStructure(new Object('Vendor\Project\MyClass'))
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

namespace Vendor\Project;

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
use Memio\Model\Contract;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\StructurePhpdoc;

$contract = (new Contract('Vendor\Project\MyInterface'))
    ->setPhpdoc((new StructurePhpdoc())
        ->setDescription((new Description('This is the first line'))
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
use Memio\Model\Property;
use Memio\Model\Phpdoc\PropertyPhpdoc;
use Memio\Model\Phpdoc\VariableTag;

$property = (new Property('myClass'))
    ->setPhpdoc((new PropertyPhpdoc())
        ->setVariableTag(new VariableTag('Vendor\Project\MyClass'))
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
use Memio\Model\Argument;
use Memio\Model\Method;
use Memio\Model\Phpdoc\ApiTag;
use Memio\Model\Phpdoc\Description;
use Memio\Model\Phpdoc\DeprecationTag;
use Memio\Model\Phpdoc\MethodPhpdoc;
use Memio\Model\Phpdoc\ParameterTag;

$method = (new Method('__construct'))
    ->setPhpdoc((new MethodPhpdoc())
        ->setDescription((new Description('This is the first line'))
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
    public function __construct(string $filename, bool $isEnabled)
    {
    }
```

> **Note**: Parameter names are aligned.

## Next readings

* [Validation Tutorial](03-validation-tutorial.md)
* [Examples](04-examples.md)
* [Templates](05-templates.md)
* [Packages](06-packages.md)

Previous pages:

* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
