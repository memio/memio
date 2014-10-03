<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class CodeNavigatorSpec extends ObjectBehavior
{
    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_selects_the_constructor(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeNavigator::CONSTRUCTOR_PATTERN);

        $this->goToConstructor($text);
    }
}
