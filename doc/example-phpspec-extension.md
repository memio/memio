# Example - phpspec extension

[phpspec](http://phpspec.net) is a tool that automates spec BDD and provides code
generation based on the specifications.

In this example we'll create an extension which generates better arguments
(typehints, objects named after their type and all!):

```php
<?php

namespace Acme\PhpSpecMedio\Generator;

use Gnugat\Medio\PrettyPrinter\InlineArgumentCollectionPrinter;
use Gnugat\Medio\Factory\VariableArgumentCollectionFactory;

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
      InlineArgumentCollectionPrinter $inlineArgumentCollectionPrinter ,
      VariableArgumentCollectionFactory $variableArgumentCollectionFactory,
    )
    {
        $this->templates = $templates;
        $this->filesystem = $filesystem;

        $this->variableArgumentCollectionFactory = $variableArgumentCollectionFactory;
        $this->inlineArgumentCollectionPrinter = $inlineArgumentCollectionPrinter;
    }

    public function generate(ResourceInterface $resource, array $data = array())
    {
        // We create a modelization of arguments, from the given variables
        $argumentCollection = $this->variableArgumentCollectionFactory->make($data['arguments']);

        // From this modelization, we generate the formated list of arguments
        $printedArguments = $this->inlineArgumentCollectionPrinter->dump($argumentCollection);

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

When we write the following spec:

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
    public function someCall($argument1, \ArrayObject $arrayObject, $argument2)
    {
    }
}
```

As you can see, the object argument has been type hinted and named after its type.
Scalar arguments have been named in a generic manner (`argument`), but name
collision has been detected so they've suffixed by a number.
