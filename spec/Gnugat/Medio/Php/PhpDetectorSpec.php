<?php

namespace spec\Gnugat\Medio\Php;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class PhpDetectorSpec extends ObjectBehavior
{
    const METHOD_NAME = 'method';
    const PUBLIC_VISIBILITY = 'public';
    const NO_VISIBILITY = '';
    const PUBLIC_METHOD_PATTERN = '/^    public function method\(/';
    const METHOD_WITHOUT_VISIBILITY_PATTERN = '/^    function method\(/';

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_detects_presence_of_method_without_visitibility(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::METHOD_WITHOUT_VISIBILITY_PATTERN, 0)->willReturn(true);

        $this->methodDeclaration($text, self::METHOD_NAME, self::NO_VISIBILITY)->shouldBe(true);
    }

    function it_detects_absence_of_method_without_visitibility(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::METHOD_WITHOUT_VISIBILITY_PATTERN, 0)->willReturn(false);

        $this->methodDeclaration($text, self::METHOD_NAME, self::NO_VISIBILITY)->shouldBe(false);
    }

    function it_detects_presence_of_method_with_public_visitibility(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::PUBLIC_METHOD_PATTERN, 0)->willReturn(true);

        $this->methodDeclaration($text, self::METHOD_NAME, self::PUBLIC_VISIBILITY)->shouldBe(true);
    }

    function it_detects_absence_of_method(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::PUBLIC_METHOD_PATTERN, 0)->willReturn(false);

        $this->methodDeclaration($text, self::METHOD_NAME, self::PUBLIC_VISIBILITY)->shouldBe(false);
    }
}
