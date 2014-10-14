<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use Gnugat\Redaktilo\Text;

class CodeDetector
{
    const USE_PATTERN = '/^use /';
    const PROPERTY_PATTERN = '/^    private \$/';
    const CONSTANT_PATTERN = '/^    const /';

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

        return !$this->editor->hasBelow($text, $namespaceStatement, 0);
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
        return $this->editor->hasBelow($text, self::USE_PATTERN);
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

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOnePropertyAbove(Text $text)
    {
        return $this->editor->hasAbove($text, self::PROPERTY_PATTERN);
    }

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOnePropertyBelow(Text $text)
    {
        return $this->editor->hasBelow($text, self::PROPERTY_PATTERN);
    }

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOneConstantAbove(Text $text)
    {
        return $this->editor->hasAbove($text, self::CONSTANT_PATTERN);
    }

    /**
     * @param Text $text
     *
     * @return bool
     */
    public function hasOneConstantBelow(Text $text)
    {
        return $this->editor->hasBelow($text, self::CONSTANT_PATTERN);
    }
}
