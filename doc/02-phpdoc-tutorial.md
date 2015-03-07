# PHPdoc Tutorial

Medio also provides a way to document the code with [PHPdoc](http://www.phpdoc.org/).

By default no PHPdoc is generated, this must be triggered by setting a PHPdoc object in the model.

![UML class diagram](http://yuml.me/94f12367)

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
    ->setStructurePhpdoc(StructurePhpdoc::make()
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
use Gnugat\Medio\Model\Phpdoc\PropertyTag;

$property = Property::make('myClass')
    ->setPhpdoc(PropertyPhpdoc::make()
        ->setPropertyTag(new PropertyTag('Gnugat\Medio\MyClass'))
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

## Next readings

* [Examples](03-examples.md)
* [Extending](04-extending.md)

Previous pages:

* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
