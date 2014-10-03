<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class CodeDetectorSpec extends ObjectBehavior
{
    const NAMESPACE_STATEMENT = 'namespace fixture\Gnugat\Medio\Dependency;';
    const NAME_SPACE = 'fixture\Gnugat\Medio\Dependency';
    const CONSTRUCTOR_BEGINING = '    public function __construct(';
    const MULTI_LINE_DEPENDENCY = '        Dependency $dependency';
    const CONSTRUCTOR_END = '    )';
    const INLINE_CONSTRUCTOR = '    public function __construct(Dependency $dependency)';
    const EMPTY_CONSTRUCTOR = '    public function __construct()';

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

    function it_detects_dependencies_of_multiline_constructor(
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

        $codeNavigator->goToConstructor($text)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyDependency($text)->shouldBe(true);
    }

    function it_detects_dependencies_of_inline_constructor(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $currentLineNumber = 0;
        $lines = array(self::INLINE_CONSTRUCTOR);

        $codeNavigator->goToConstructor($text)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyDependency($text)->shouldBe(true);
    }

    function it_detects_no_dependency_with_empty_constructor(
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $currentLineNumber = 0;
        $lines = array(self::EMPTY_CONSTRUCTOR);

        $codeNavigator->goToConstructor($text)->shouldBeCalled();
        $text->getLines()->willReturn($lines);
        $text->getCurrentLineNumber()->willReturn($currentLineNumber);

        $this->hasAnyDependency($text)->shouldBe(false);
    }
}
