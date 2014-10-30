<?php

namespace Gnugat\Medio\Php;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

/**
 * Detects the presence of:
 *
 * + a method declaration
 */
class PhpDetector
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
     * @param string $name
     * @param string $visibility
     *
     * @return bool
     */
    public function methodDeclaration(Text $text, $name, $visibility = 'public')
    {
        if ('' !== $visibility) {
            $visibility .= ' ';
        }
        $pattern = sprintf('/^    %sfunction %s\(/', $visibility, $name);

        return $this->editor->hasBelow($text, $pattern, 0);
    }
}
