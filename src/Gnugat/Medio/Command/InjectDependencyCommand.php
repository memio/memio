<?php

namespace Gnugat\Medio\Command;

use Gnugat\Medio\Convertor;
use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Redaktilo\Editor;

class InjectDependencyCommand implements Command
{
    /**
     * @var CodeDetector
     */
    private $codeDetector;

    /**
     * @var CodeEditor
     */
    private $codeEditor;

    /**
     * @var Convertor
     */
    private $convertor;

    /**
     * @var Editor
     */
    private $editor;

    /**
     * @param CodeDetector $codeDetector
     * @param CodeEditor   $codeEditor
     * @param Convertor    $convertor
     * @param Editor       $editor
     */
    public function __construct(
        CodeDetector $codeDetector,
        CodeEditor $codeEditor,
        Convertor $convertor,
        Editor $editor
    )
    {
        $this->codeDetector = $codeDetector;
        $this->codeEditor = $codeEditor;
        $this->convertor = $convertor;
        $this->editor = $editor;
    }

    /**
     * @param string $fullyQualifiedClassname
     * @param string $filename
     *
     * @return int
     */
    public function run($fullyQualifiedClassname, $filename)
    {
        $namespace = $this->convertor->toNamespace($fullyQualifiedClassname);
        $className = $this->convertor->toClassName($fullyQualifiedClassname);
        $variableName = $this->convertor->toVariableName($className);

        $file = $this->editor->open($filename);
        if ($this->codeDetector->isUseNeeded($file, $namespace)) {
            $this->codeEditor->addUse($file, $fullyQualifiedClassname);
        }
        $this->codeEditor->addProperty($file, $variableName);
        $this->codeEditor->addArgument($file, '__construct', $variableName, $className);
        $this->codeEditor->addPropertyInitialization($file, '__construct', $variableName);
        $this->editor->save($file);

        return Command::EXIT_SUCCESS;
    }
}
