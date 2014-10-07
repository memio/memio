<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class MultilineEditor
{
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
     * @param CodeDetector  $codeDetector
     * @param CodeNavigator $codeNavigator
     * @param Editor        $editor
     */
    public function __construct(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor
    )
    {
        $this->codeDetector = $codeDetector;
        $this->codeNavigator = $codeNavigator;
        $this->editor = $editor;
    }

    /**
     * @param Text   $text
     * @param string $methodName
     * @param string $argumentName
     * @param string $argumentType
     */
    public function addArgument(Text $text, $methodName, $argumentName, $argumentType = null)
    {
        $this->codeNavigator->goToMethod($text, $methodName);
        while ($this->codeDetector->hasOneArgumentBelow($text)) {
            $this->codeNavigator->goOneLineBelow($text);
        }
        $this->editor->replace($text, function ($line) {
            return $line.',';
        });
        $argument = '        ';
        $argument .= $argumentType ? $argumentType.' ' : '';
        $argument .= sprintf('$%s', $argumentName);
        $this->editor->insertBelow($text, $argument);
    }
}
