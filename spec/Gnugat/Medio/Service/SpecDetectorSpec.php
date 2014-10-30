<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class SpecDetectorSpec extends ObjectBehavior
{
    const METHOD = 'it_describes_a_behavior';
    const METHOD_PATTERN = '/^    function it_describes_a_behavior\(/';

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_detects_presence_of_method(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::METHOD_PATTERN, 0)->willReturn(true);

        $this->hasMethod($text, self::METHOD)->shouldBe(true);
    }

    function it_detects_absence_of_method(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::METHOD_PATTERN, 0)->willReturn(false);

        $this->hasMethod($text, self::METHOD)->shouldBe(false);
    }
}
