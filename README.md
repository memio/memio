# Medio

A highly opiniated code generator library.

Currently provides only a way to generate arguments for a class method:

* objects, array and callable are typehinted
* can automatically name the arguments for you
* arguments are renamed to avoid collision, when necessary

## Installation

Use [Composer](https://getcomposer.org/download):

    composer require gnugat/medio:~0.3

## Details

Medio provides a modelisation of your code (in `Gnugat\Medio\Model`):

* a `Method` has an `ArgumentCollection`
* an `ArgumentCollection` can have 0 to many `Argument`, it also takes care of avoiding name collision
* an `Argument` has a type, a name and a way to tell if it's an object or not

Creating those models manually can be tedious, so factories are provided (in `Gnugat\Medio\Factory`):

* `ArgumentFactory` can create an `Argument` from a given type or a given variable

Once modelized, the code can be generated using "pretty printers" (in `Gnugat\Medio\PrettyPrinter`):

* `ArgumentPrinter` takes care of type hinting
* `ArgumentCollectionPrinter` makes an inline list of arguments

> **Note**: those "pretty printer" aren't "fidelity printers", they'll format the
> code based on highly opinions (they can be considered as "nice printers").

## Example

[phpspec](http://phpspec.net) is a tool that automates spec BDD and provides code
generation based on the specifications.

In this example we'll create an extension which generates a better argument generation:

```php
<?php

namespace Acme\PhpSpecMedio\Generator;

use Gnugat\Medio\PrettyPrinter\ArgumentCollectionPrinter;
use Gnugat\Medio\Factory\ArgumentFactory;

use PhpSpec\CodeGenerator\Generator\GeneratorInterface;
use PhpSpec\CodeGenerator\TemplateRenderer;
use PhpSpec\Locator\ResourceInterface;
use PhpSpec\Util\Filesystem;

class TypeHintedMethodGenerator implements GeneratorInterface
{
    private $templates;
    private $filesystem;

    public function __construct(
      TemplateRenderer $templates,
      Filesystem $filesystem,
      ArgumentCollectionPrinter $argumentFactory,
      ArgumentFactory $argumentCollectionPrinter,
    )
    {
        $this->templates = $templates;
        $this->filesystem = $filesystem;

        $this->argumentFactory = $argumentFactory;
        $this->argumentCollectionPrinter = $argumentCollectionPrinter;
    }

    public function generate(ResourceInterface $resource, array $data = array())
    {
        // We create a modelization of arguments, from the given variables
        $argumentCollection = new ArgumentCollection();
        foreach ($data['arguments'] as $argument) {
          $argumentCollection->add($this->argumentFactory->makeFromVariable($argument));
        }
        // From this modelization, we generate the formated list of arguments
        $printedArguments = $this->argumentCollectionPrinter->format($argumentCollection);

        // The rest is phpspec gibberish to generate the code...
        $content = $this->templates->render('method', array(
            '%name%' => $data['name'],
            '%arguments%' => $printedArguments,
        ));
        $filename = $resource->getSrcFilename();
        $code = $this->filesystem->getFileContents($filename);
        $code = preg_replace('/}[ \n]*$/', rtrim($content) ."\n}\n", trim($code));
        $this->filesystem->putFileContents($filename, $code);
    }

    public function supports(ResourceInterface $resource, $generation, array $data)
    {
        return 'method' === $generation;
    }

    public function getPriority()
    {
        return 0;
    }
}
```

If we then write the following spec:

```php
<?php

namespace spec\Acme\PhpSpecMedio\MyClass;

use PhpSpec\ObjectBehavior;

class MyClassSpec extends ObjectBehavior
{
    function it_does_something()
    {
        $aString = 'Nobody expects the Spanish Inquisition!';
        $anObject = new \ArrayObject();
        $aBoolean

        $this->someCall($aString, $anObject, $aBoolean);
    }
}
```

Then phpspec will generate the following code:

```php
<?php

namespace Acme\PhpSpecMedio\MyClass;

class MyClass
{
    public function someCall($argument1, ArrayObject $arrayObject, $argument2)
    {
    }
}
```

As you can see, the object argument has been type hinted and named after its type.
The scalar arguments have been named genericly (`argument`), but name collision
has been detected so they've suffixed by a number.
