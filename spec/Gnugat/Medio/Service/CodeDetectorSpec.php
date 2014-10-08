<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class CodeDetectorSpec extends ObjectBehavior
{
    const NAMESPACE_STATEMENT = 'namespace fixture\Gnugat\Medio\Dependency;';
    const NAME_SPACE = 'fixture\Gnugat\Medio\Dependency';
    const CONSTRUCTOR_BEGINING = '    public function __construct(';
    const MULTI_LINE_DEPENDENCY = '        Dependency $dependency';
    const CONSTRUCTOR_END = '    )';
    const METHOD_NAME = '__construct';
    const INLINE_CONSTRUCTOR = '    public function __construct(Dependency $dependency)';
    const EMPTY_CONSTRUCTOR = '    public function __construct()';
    const METHOD_PATTERN = '/^    public function __construct\(/';
    const LINE_NUMBER = 42;
    const ARGUMENT_BELOW = '        OtherDependency $otherDependency';
    const NO_ARGUMENT_BELOW = '    )';
    const INLINE_ARGUMENTS_PATTERN = '/^    public function __construct\((.*)\)$/';

    function let(CodeNavigator $codeNavigator, Editor $editor)
    {
        $this->beConstructedWith($codeNavigator, $editor);
    }

    function it_detects_if_use_statement_is_needed(Editor $editor, Text $text)
    {
        $editor->has($text, self::NAMESPACE_STATEMENT)->willReturn(true);

        $this->isUseNeeded($text, self::NAME_SPACE)->shouldBe(false);
    }

    function it_detects_if_use_statement_is_not_needed(Editor $editor, Text $text)
    {
        $editor->has($text, self::NAMESPACE_STATEMENT)->willReturn(false);

        $this->isUseNeeded($text, self::NAME_SPACE)->shouldBe(true);
    }

    function it_detects_arguments_of_multiline_method(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $currentLineNumber = 0;
        $lines = array(
            self::CONSTRUCTOR_BEGINING,
            self::MULTI_LINE_DEPENDENCY,
            self::CONSTRUCTOR_END,
        );

        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyArguments($text, self::METHOD_NAME)->shouldBe(true);
    }

    function it_detects_arguments_of_inline_method(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $currentLineNumber = 0;
        $lines = array(self::INLINE_CONSTRUCTOR);

        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyArguments($text, self::METHOD_NAME)->shouldBe(true);
    }

    function it_detects_no_arguments_with_empty_method(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $currentLineNumber = 0;
        $lines = array(self::EMPTY_CONSTRUCTOR);

        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyArguments($text, self::METHOD_NAME)->shouldBe(false);
    }

    function it_detects_no_arguments_with_missing_method(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            self::METHOD_PATTERN
        );
        $codeNavigator->goToMethod($text, self::METHOD_NAME)->willThrow($patternNotFoundException);

        $this->hasAnyArguments($text, self::METHOD_NAME)->shouldBe(false);
    }

    function it_detects_presence_of_next_use(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, CodeDetector::USE_PATTERN)->shouldBeCalled();

        $this->hasOneUseBelow($text)->shouldBe(true);
    }

    function it_detects_absence_of_next_use(Editor $editor, Text $text)
    {
        $patternNotFoundException = new PatternNotFoundException(
            $text->getWrappedObject(),
            CodeDetector::USE_PATTERN
        );
        $editor->jumpBelow($text, CodeDetector::USE_PATTERN)->willThrow($patternNotFoundException);

        $this->hasOneUseBelow($text)->shouldBe(false);
    }

    function it_detects_presence_of_next_argument(Text $text)
    {
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $text->getLine(self::LINE_NUMBER + 1)->willReturn(self::ARGUMENT_BELOW);

        $this->hasOneArgumentBelow($text)->shouldBe(true);
    }

    function it_detects_absence_of_next_argument(Text $text)
    {
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $text->getLine(self::LINE_NUMBER + 1)->willReturn(self::NO_ARGUMENT_BELOW);

        $this->hasOneArgumentBelow($text)->shouldBe(false);
    }

    function it_detects_multiline_arguments(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::INLINE_ARGUMENTS_PATTERN, 0)->willReturn(false);

        $this->hasMultilineArguments($text, self::METHOD_NAME)->shouldBe(true);
    }

    function it_detects_inline_arguments(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, self::INLINE_ARGUMENTS_PATTERN, 0)->willReturn(true);

        $this->hasMultilineArguments($text, self::METHOD_NAME)->shouldBe(false);
    }

    function it_detects_presence_of_next_property(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, CodeDetector::PROPERTY_PATTERN)->willReturn(true);

        $this->hasOnePropertyBelow($text)->shouldBe(true);
    }

    function it_detects_absence_of_next_property(Editor $editor, Text $text)
    {
        $editor->hasBelow($text, CodeDetector::PROPERTY_PATTERN)->willReturn(false);

        $this->hasOnePropertyBelow($text)->shouldBe(false);
    }
}
