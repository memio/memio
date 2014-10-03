<?php

namespace Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;

class CodeDetector
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
     * @param string $namespace
     *
     * @return bool
     */
    public function isUseNeeded(Text $text, $namespace)
    {
        $namespaceStatement = sprintf('namespace %s;', $namespace);

        return !$this->editor->has($text, $namespaceStatement);
    }
}
