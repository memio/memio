# Templates

Medio provides a "pretty printer" to generate the code. It uses [Twig](http://twig.sensiolabs.org/)
behind the scenes, a powerful templating engine.

> Keep in mind that the templates provided out of the box are highly opinionated,
> but they can be extended / over wrote.

* [Pretty Printer](#pretty-printer)
* [Conventions](#conventions)
* [Puli](#puli)

See also [next readings](#next-readings).

## Pretty printer

Its API is pretty straightforward:

```php
<?php

namespace Gnugat\Medio;

use Twig_Environment;

class PrettyPrinter
{
    public function __construct(Twig_Environment $twig);
    public function generateCode($model, array $parameters = array());
}
```

You can build it like this:

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\PrettyPrinter;

$loader = \Twig_Loader_Filesystem(__DIR__.'/vendor/gnugat/medio/templates'); // Replace this path
$twig = new \Twig_Environment($loader);
$prettyPrinter = new PrettyPrinter($twig);
```

## Conventions

A model's templates is named after its class name, in snake_case. It always take
as its first argument the model (the variable is also named after the model's class anme in snake_case).

> For instance, `ArgumentCollection` should have a template named `argument_collection.twig`.
> The template should receive the model, in the `argument_collection` parameter.

"Sub-templates" should be prefixed with an underscore.

> For example: `_inline_argument_collection.twig`.

## Puli

Using [puli](http://docs.puli.io/), you can get easily Medio's `templates` path.

First install the composer's plugin:

    composer require puli/composer-plugin:~1.0@beta

Then in your code you need to create a Puli repository:

```php
<?php

$factoryClass = PULI_FACTORY_CLASS;
$factory = new $factoryClass();
$repository = $factory->createRepository();
```

Using this repository you can get the path:

```php
$medioTemplatesPath = $repository->get('/gnugat/medio/templates')->getFilesystemPath();
```

## Next readings

* [Examples](03-examples.md)
