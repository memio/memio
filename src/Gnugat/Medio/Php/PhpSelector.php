<?php

namespace Gnugat\Medio\Php;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class PhpSelector
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
     * @throws \Gnugat\Redaktilo\Search\PatternNotFoundException If the method is not found
     */
    public function methodDeclaration(Text $text, $name, $visibility = 'public')
    {
        if ('' !== $visibility) {
            $visibility .= ' ';
        }
        $pattern = sprintf('/^    %sfunction %s\(/', $visibility, $name);
        $this->editor->jumpBelow($text, $pattern, 0);
    }
}
