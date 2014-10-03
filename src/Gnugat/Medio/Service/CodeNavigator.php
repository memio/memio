<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class CodeNavigator
{
    const CONSTRUCTOR_PATTERN = '/^    public function __construct\(/';

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
     * @param Text $text
     */
    public function goToConstructor(Text $text)
    {
        $this->editor->jumpBelow($text, self::CONSTRUCTOR_PATTERN, 0);
    }
}
