<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class SpecDetector
{
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
     * @return bool
     */
    public function hasMethod(Text $text, $methodName)
    {
        $methodPattern = sprintf('/^    function %s\(/', $methodName);

        return $this->editor->hasBelow($text, $methodPattern, 0);
    }
}
