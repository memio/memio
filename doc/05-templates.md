# Templates

Memio uses [Twig templates](http://twig.sensiolabs.org/) to actualy generate the
code, they can be found in `templates`.

## Overriding templates

The templates provided out of the box put an empty line between the PHP opening
tag and the namespace statement:

```php
<?php

namespace Vendor\Project;
```

In this example we're going to change the template to remove the empty line:

```php
<?php
namespace Vendor\Project;
```

To do so we'll need to copy the `file.twig` template in our project:

```
{#- File: my_templates/file.twig -#}
<?php
{% if file.licensePhpdoc is not empty %}

{% include 'phpdoc/license_phpdoc.twig' with { 'license_phpdoc': file.licensePhpdoc } only %}
{% endif %}
namespace {{ file.namespace }};

{% include 'collection/fully_qualified_name_collection.twig' with {
    'fully_qualified_name_collection': file.allFullyQualifiedNames
} only %}
{% if needs_line_after(file, 'fully_qualified_names') %}

{% endif %}
{% if file.structure is contract %}
{% include 'contract.twig' with { 'contract': file.structure } only %}
{% else %}
{% include 'object.twig' with { 'object': file.structure } only %}
{% endif %}
```

We've removed the line between `{% endif %}` and `namespace {{ file.namespace }};`.

In order for our template to be used, we'll need to add it to the `Twig_Loader_Filesystem`
used by our `PrettyPrinter` (must be loaded first):

```php
<?php
// File: my_medio.php

require __DIR__.'/vendor/autoload.php';

use Memio\Memio\Config\Path;
use Memio\Memio\PrettyPrinter;

$loader = new \Twig_Loader_Filesystem(__DIR__.'/my_templates');
$loader->addPath(Path::templates());
$twig = new \Twig_Environment($loader);
$prettyPrinter = new PrettyPrinter($twig);
```

And we're done!

Let's check the result:

```php
// File: my_medio.php

use Memio\Model\File;
use Memio\Model\Object;

$file = File::make('src/Vendor/Project/MyClass.php')
    ->setStructure(new Object('Vendor\Project\MyClass'))
;

echo $prettyPrinter->generateCode($file);
```

This will output:

```php
<?php
namespace Vendor\Project;

class MyClass
{
}
```

## Next readings

Previous pages:

* [Examples](04-examples.md)
* [Validation Tutorial](03-validation-tutorial.md)
* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
