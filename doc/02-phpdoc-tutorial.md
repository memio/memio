# PHPdoc Tutorial

Medio also provides a way to document the code with [PHPdoc](http://www.phpdoc.org/).

By default no PHPdoc is generated, this must be triggered by setting a PHPdoc object in the model.

## 1. License

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

## Next readings

* [Examples](03-examples.md)
* [Extending](04-extending.md)

Previous pages:

* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
