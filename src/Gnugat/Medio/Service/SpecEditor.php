<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class SpecEditor
{
    const METHOD_OPENING = '    {';
    const METHOD_ENDING = '    }';
    const CLASS_ENDING = '}';

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
     */
    public function addMethod(Text $text, $methodName)
    {
        $method = sprintf('    function %s()', $methodName);

        $this->editor->jumpBelow($text, self::CLASS_ENDING, 0);

        $this->editor->insertAbove($text, self::METHOD_ENDING);
        $this->editor->insertAbove($text, self::METHOD_OPENING);
        $this->editor->insertAbove($text, $method);
    }
}
