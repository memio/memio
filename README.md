# Medio

A [highly opiniated](./doc/42-vocabulary.md) code helper.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\Convertor;
use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Medio\Service\MultilineEditor;
use Gnugat\Medio\Command\InjectDependencyCommand;
use Gnugat\Redaktilo\EditorFactory;

$convertor = new Convertor();
$editor = EditorFactory::createEditor();
$codeNavigator = new CodeNavigator($editor);
$codeDetector = new CodeDetector($codeNavigator, $editor);
$multilineEditor = new MultilineEditor($codeDetector, $codeNavigator, $editor);
$codeEditor = new CodeEditor($codeDetector, $codeNavigator, $editor, $multilineEditor);
$injectDependencyCommand = new InjectDependencyCommand($codeDetector, $codeEditor, $convertor, $editor);

$filename = __DIR__'/vendor/gnugat/medio/test/before/EmptyService.php';
$fullyQualifiedClassname = 'fixture\Gnugat\Medio\Dependency';
$file = $editor->open($filename);

$codeNavigator->goToMethod($file, '__construct');
$file->getCurrentLineNumber(); // 8
$codeDetector->isUseNeeded($file, $fullyQualifiedClassname); // true
$codeEditor->addUse($file, $fullyQualifiedClassname);
$file->getLine(); // use fixture\Gnugat\Medio\Dependency;

$injectDependencyCommand->run($fullyQualifiedClassname, $filename); // see ./doc/21-inject-dependency.md
```

Two kinds of classes can be found:

* [Services](#services)
* [Commands](#commands)

## Services

Classes which manipulate simple unit of code:

* CodeNavigator, sets the current line to:
    * the namespace
    * the class opening brace
    * the property below the current line
    * a method
    * a method closing brace
    * the line below the current line
* CodeDetector, checks:
    * the need of a use statement
    * the presence of a use statement below the current line
    * the presence of a property above the current line
    * the presence of a property below the current line
    * the presence of arguments in a method
    * if the methods argument are inlined
    * the presence of a method argument below the current line
* MutlilineEditor inserts:
    * a new argument in a method where the arguments are spread on many lines
* CodeEditor, inserts:
    * a use statement
    * a property
    * a method argument
    * a property initiaization

Those classes expects an instance of `Gnugat\Redaktilo\Text`, their changes are
only made in memory.

## Commands

Classes which do smart manipulations, using services:

* InjectDependencyCommand:
    * inserts a use statement if needed
    * inserts a new property
    * inserts a constructor argument
    * inserts the property initialization in the constructor

Thoses classes expects a filename, they will open the file, apply changes to it
and save them on the filesystem.
