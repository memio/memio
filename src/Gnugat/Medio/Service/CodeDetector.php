<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
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
     * @param Text $text
     *
     * @return bool
     */
    public function hasAnyDependency(Text $text)
    {
        $this->codeNavigator->goToConstructor($text);
        $lines = $text->getLines();
        $lineNumber = $text->getCurrentLineNumber();
        $firstLine = str_replace('    public function __construct(', '', $lines[$lineNumber]);
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
        $this->editor->jumpBelow($text, self::USE_PATTERN);

        return true;
    }
}
