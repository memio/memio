<?php

namespace spec\Gnugat\Medio\Php;

use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class SelectorSpec extends ObjectBehavior
{
    const METHOD_NAME = 'method';
    const METHOD_WITHOUT_VISIBILITY = '/^    function method\(/';
    const PUBLIC_METHOD = '/^    public function method\(/';

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_selects_method_without_visibility(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, self::METHOD_WITHOUT_VISIBILITY, 0)->shouldBeCalled();

        $this->methodDeclaration($text, self::METHOD_NAME, '');
    }

    function it_selects_method_with_visibility(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, self::PUBLIC_METHOD, 0)->shouldBeCalled();

        $this->methodDeclaration($text, self::METHOD_NAME, 'public');
    }

    function it_cannot_select_missing_method(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            self::PUBLIC_METHOD
        );
        $editor->jumpBelow($text, self::PUBLIC_METHOD, 0)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringMethodDeclaration($text, self::METHOD_NAME, 'public');
    }
}
