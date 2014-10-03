<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeNavigator;
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

    function it_selects_the_next_property(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeNavigator::PROPERTY_PATTERN)->shouldBeCalled();

        $this->goOnePropertyBelow($text);
    }
}
