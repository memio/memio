<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class CodeNavigatorSpec extends ObjectBehavior
{
    const METHOD_NAME = '__construct';
    const METHOD_PATTERN = '/^    public function __construct\(/';
    const LINE_NUMBER = 23;

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_selects_a_method(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, self::METHOD_PATTERN, 0)->shouldBeCalled();

        $this->goToMethod($text, self::METHOD_NAME);
    }

    function it_cannot_select_missing_method(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            self::METHOD_PATTERN
        );
        $editor->jumpBelow($text, self::METHOD_PATTERN, 0)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringGoToMethod($text, self::METHOD_NAME);
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

    function it_selects_the_next_line(Text $text)
    {
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $text->setCurrentLineNumber(self::LINE_NUMBER + 1)->shouldBeCalled();

        $this->goOneLineBelow($text);
    }

    function it_cannot_select_next_line_after_end_of_file(Text $text)
    {
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $invalidArgumentException = '\InvalidArgumentException';
        $text->setCurrentLineNumber(self::LINE_NUMBER + 1)->willThrow($invalidArgumentException);

        $this->shouldThrow($invalidArgumentException)->duringGoOneLineBelow($text);
    }

    function it_selects_the_class_opening(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeNavigator::CLASS_OPENING_PATTERN, 0)->shouldBeCalled();

        $this->goToClassOpening($text);
    }

    function it_cannot_select_missing_class_opening(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            CodeNavigator::CLASS_OPENING_PATTERN
        );
        $editor->jumpBelow($text, CodeNavigator::CLASS_OPENING_PATTERN, 0)->willThrow($patternNotFoundException);

        $this->shouldThrow($patternNotFoundException)->duringGoToClassOpening($text);
    }
}
