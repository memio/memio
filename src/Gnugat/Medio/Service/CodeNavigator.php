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

class CodeNavigator
{
    const CONSTRUCTOR_PATTERN = '/^    public function __construct\(/';
    const PROPERTY_PATTERN = '/^    private \$/';
    const NAMESPACE_PATTERN = '/^namespace /';
    const CLASS_OPENING_PATTERN = '/^{$/';
    const METHOD_CLOSING_PATTERN = '/^    }$/';

    /**
     * @var Editor
     */
    private $editor;

    /**
     * @param Editor $editor
     */
    public function __construct(Editor $editor)
    {
        $this->editor = $editor;
    }

    /**
     * @param Text   $text
     * @param string $methodName
     *
     * @throws PatternNotFoundException If the constructor is missing
     */
    public function goToMethod(Text $text, $methodName)
    {
        $methodPattern = sprintf('/^    public function %s\(/', $methodName);
        $this->editor->jumpBelow($text, $methodPattern, 0);
    }

    /**
     * @param Text $text
     *
     * @throws PatternNotFoundException If there's no property below
     */
    public function goOnePropertyBelow(Text $text)
    {
        $this->editor->jumpBelow($text, self::PROPERTY_PATTERN);
    }

    /**
     * @param Text $text
     *
     * @throws PatternNotFoundException If the namespace is missing
     */
    public function goToNamespace(Text $text)
    {
        $this->editor->jumpBelow($text, self::NAMESPACE_PATTERN, 0);
    }

    /**
     * @param Text $text
     *
     * @throws \InvalidArgumentException If the bottom of the file has been reached
     */
    public function goOneLineBelow(Text $text)
    {
        $lineNumber = $text->getCurrentLineNumber();
        $text->setCurrentLineNumber($lineNumber + 1);
    }

    /**
     * @param Text $text
     *
     * @throws PatternNotFoundException If the class is missing
     */
    public function goToClassOpening(Text $text)
    {
        $this->editor->jumpBelow($text, self::CLASS_OPENING_PATTERN, 0);
    }

    /**
     * @param Text   $text
     * @param string $methodName
     *
     * @throws PatternNotFoundException If the method is missing
     */
    public function goToMethodClosing(Text $text, $methodName)
    {
        $this->goToMethod($text, $methodName);
        $this->editor->jumpBelow($text, self::METHOD_CLOSING_PATTERN);
    }
}
