# Templates

The actual code generation logic is hold by [Twig templates](http://twig.sensiolabs.org/),
which an be found in [memio/twig-template-engine](http://github.com/memio/twig-template-engine).

Those templates enforce a highly opinionated coding style based on [PHP standards](http://www.php-fig.org/),
but they can be easily over loaded with custom ones.

> **Note**: Memio isn't tied to Twig, we can provide alternative template engines
> by creating a package that would depend on [memio/pretty-printer](http://github.com/memio/pretty-printer)
> and by rewriting all the templates.

## Overriding templates

In this example, we'll over load the `file` template to remove the empty line
between PHP opening tag and the namespace statement.

Before:

```php
<?php

namespace Vendor\Project;
```

After:

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

In order for our custom template to be used, we'll need to add its directory path to `PrettyPrinter`:

```php
// ...

$prettyPrinter->addTemplatePath(__DIR__.'/my_templates');
```

And we're done!

Let's check the result:

```php
// ...

use Memio\Model\File;
use Memio\Model\Object;

$file = (new File('src/Vendor/Project/MyClass.php'))
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

* [Packages](06-packages.md)

Previous pages:

* [Examples](04-examples.md)
* [Validation Tutorial](03-validation-tutorial.md)
* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
