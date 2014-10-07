<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\File;
use Gnugat\Redaktilo\Text;
use Gnugat\Redaktilo\Search\PatternNotFoundException;

class CodeEditor
{
    const EMPTY_LINE = '';

    /**
     * @var CodeDetector
     */
    private $codeDetector;

    /**
     * @var CodeNavigator
     */
    private $codeNavigator;

    /**
     * @var Editor
     */
    private $editor;

    /**
     * @var MultilineEditor
     */
    private $multilineEditor;

    /**
     * @param CodeDetector    $codeDetector
     * @param CodeNavigator   $codeNavigator
     * @param Editor          $editor
     * @param MultilineEditor $multilineEditor
     */
    public function __construct(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        MultilineEditor $multilineEditor
    )
    {
        $this->codeDetector = $codeDetector;
        $this->codeNavigator = $codeNavigator;
        $this->editor = $editor;
        $this->multilineEditor = $multilineEditor;
    }

    /**
     * @param string $filename
     *
     * @return File
     */
    public function open($filename)
    {
        return $this->editor->open($filename);
    }

    /**
     * @param File $file
     */
    public function save(File $file)
    {
        return $this->editor->save($file);
    }

    /**
     * @param Text   $text
     * @param string $fullyQualifiedClassname
     */
    public function addUse(Text $text, $fullyQualifiedClassname)
    {
        $useStatement = sprintf('use %s;', $fullyQualifiedClassname);

        $this->codeNavigator->goToNamespace($text);
        $this->codeNavigator->goOneLineBelow($text);
        $this->editor->insertBelow($text, $useStatement);
        if (!$this->codeDetector->hasOneUseBelow($text)) {
            $this->editor->insertBelow($text, self::EMPTY_LINE);
        }
    }

    /**
     * @param Text   $text
     * @param string $variableName
     */
    public function addProperty(Text $text, $variableName)
    {
        $property = sprintf('    private $%s;', $variableName);
        $emptyLine = '';

        $this->codeNavigator->goToClassOpening($text);
        while ($this->codeDetector->hasOneUseBelow($text)) {
            $this->codeNavigator->goOneUseBelow($text);
        }
        $this->editor->insertBelow($text, $property);
        $this->editor->insertBelow($text, self::EMPTY_LINE);
    }

    /**
     * @param Text   $text
     * @param string $methodName
     * @param string $argumentName
     * @param string $argumentType
     */
    public function addArgument(Text $text, $methodName, $argumentName, $argumentType = null)
    {
        if ($this->codeDetector->hasMultilineArguments($text, $methodName)) {
            $this->multilineEditor->addArgument($text, $methodName, $argumentName, $argumentType);

            return;
        }
        $this->codeNavigator->goToMethod($text, $methodName);
        $currentConstructor = $text->getLine();
        $constructorArgument = '';
        if ($this->codeDetector->hasAnyArguments($text, $methodName)) {
            $constructorArgument .= ', ';
        }
        $constructorArgument .= $argumentType ? $argumentType.' ' : '';
        $constructorArgument .= '$'.$argumentName;
        $newConstructor = str_replace(')', $constructorArgument.')', $currentConstructor);
        $this->editor->replace($text, $newConstructor);
    }
}
