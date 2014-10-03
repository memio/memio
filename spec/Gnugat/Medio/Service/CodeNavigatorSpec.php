<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
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
        $editor->jumpBelow($text, CodeNavigator::CONSTRUCTOR_PATTERN, 0)->shouldBeCalled();

        $this->goToConstructor($text);
    }

    function it_cannot_select_missing_constructor(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            CodeNavigator::CONSTRUCTOR_PATTERN
        );
        $editor->jumpBelow($text, CodeNavigator::CONSTRUCTOR_PATTERN, 0)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringGoToConstructor($text);
    }

    function it_selects_the_next_property(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeNavigator::PROPERTY_PATTERN)->shouldBeCalled();

        $this->goOnePropertyBelow($text);
    }

    function it_cannot_select_missing_property(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            CodeNavigator::PROPERTY_PATTERN
        );
        $editor->jumpBelow($text, CodeNavigator::PROPERTY_PATTERN)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringGoOnePropertyBelow($text);
    }

    function it_selects_the_namespace(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeNavigator::NAMESPACE_PATTERN, 0)->shouldBeCalled();

        $this->goToNamespace($text);
    }

    function it_cannot_select_missing_namespace(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            CodeNavigator::NAMESPACE_PATTERN
        );
        $editor->jumpBelow($text, CodeNavigator::NAMESPACE_PATTERN, 0)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringGoToNamespace($text);
    }

}
