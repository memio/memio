<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use Gnugat\Redaktilo\Text;

class CodeDetector
{
    const USE_PATTERN = '/^use /';

    /**
     * @var CodeNavigator
     */
    private $codeNavigator;

    /**
     * @var Editor
     */
    private $editor;

    /**
     * @param CodeNavigator $codeNavigator
     * @param Editor        $editor
     */
    public function __construct(CodeNavigator $codeNavigator, Editor $editor)
    {
        $this->codeNavigator = $codeNavigator;
        $this->editor = $editor;
    }

    /**
     * @param Text   $text
     * @param string $namespace
     *
     * @return bool
     */
    public function isUseNeeded(Text $text, $namespace)
    {
        $namespaceStatement = sprintf('namespace %s;', $namespace);

        return !$this->editor->has($text, $namespaceStatement);
    }

    /**
     * @param Text   $text
     * @param string $methodName
     *
     * @return bool
     */
    public function hasAnyArguments(Text $text, $methodName)
    {
        try {
            $this->codeNavigator->goToMethod($text, $methodName);
        } catch (PatternNotFoundException $e) {
            return false;
        }
        $lines = $text->getLines();
        $lineNumber = $text->getCurrentLineNumber();
        $toReplace = sprintf('    public function %s(', $methodName);
        $firstLine = str_replace($toReplace, '', $lines[$lineNumber]);
        if (!empty($firstLine)) {
            return $firstLine !== ')';
        }
        $secondLine = trim($lines[$lineNumber + 1]);

        return !empty($secondLine) && $secondLine[0] !== ')';
    }

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOneUseBelow(Text $text)
    {
        try {
            $this->editor->jumpBelow($text, self::USE_PATTERN);
        } catch (PatternNotFoundException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOneArgumentBelow(Text $text)
    {
        $lineNumber = $text->getCurrentLineNumber();
        $line = $text->getLine($lineNumber + 1);

        return ($line !== '    )');
    }

    /**
     * @param Text   $text
     * @param string $methodName
     *
     * @return bool
     */
    public function hasMultilineArguments(Text $text, $methodName)
    {
        $inlineArgumentsPattern = sprintf('/^    public function %s\((.*)\)$/', $methodName);
        $hasInlineArguments = $this->editor->hasBelow($text, $inlineArgumentsPattern, 0);

        return !$hasInlineArguments;
    }
}
