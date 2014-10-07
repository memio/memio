<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\File;
use Gnugat\Redaktilo\Text;
use Gnugat\Redaktilo\Search\PatternNotFoundException;
use PhpSpec\ObjectBehavior;

class CodeEditorSpec extends ObjectBehavior
{
    const FILENAME = 'fixture/Gnugat/Medio/Service.php';
    const FULLY_QUALIFIED_CLASSNAME = 'fixture\Gnugat\Medio\Dependency';

    const USE_STATEMENT = 'use fixture\Gnugat\Medio\Dependency;';
    const PROPERTY = '    private $dependency;';
    const VARIABLE_NAME = 'dependency';
    const EMPTY_CONSTRUCTOR = '    public function __construct()';
    const LINE_NUMBER = 0;
    const CONSTRUCTOR_ONE_ARGUMENT = '    public function __construct(Dependency $dependency)';
    const METHOD_NAME = '__construct';
    const ARGUMENT_TYPE = 'Dependency';
    const ARGUMENT_NAME = 'dependency';
    const INLINE_CONSTRUCTOR = '    public function __construct(OtherDependency $otherDependency)';
    const INLINE_CONSTRUCTOR_ARGUMENTS = '    public function __construct(OtherDependency $otherDependency, Dependency $dependency)';

    function let(CodeDetector $codeDetector, CodeNavigator $codeNavigator, Editor $editor)
    {
        $this->beConstructedWith($codeDetector, $codeNavigator, $editor);
    }

    function it_opens_a_file(Editor $editor, File $file)
    {
        $editor->open(self::FILENAME)->willReturn($file);

        $this->open(self::FILENAME)->shouldBe($file);
    }

    function it_saves_a_file(Editor $editor, File $file)
    {
        $editor->save($file)->shouldBeCalled();

        $this->save($file);
    }

    function it_inserts_use_statement(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $codeNavigator->goToNamespace($text)->shouldBeCalled();
        $codeNavigator->goOneLineBelow($text)->shouldBeCalled();
        $editor->insertBelow($text, self::USE_STATEMENT)->shouldBeCalled();
        $codeDetector->hasOneUseBelow($text)->willReturn(true);

        $this->addUse($text, self::FULLY_QUALIFIED_CLASSNAME);
    }

    function it_inserts_first_use_statement(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $codeNavigator->goToNamespace($text)->shouldBeCalled();
        $codeNavigator->goOneLineBelow($text)->shouldBeCalled();
        $editor->insertBelow($text, self::USE_STATEMENT)->shouldBeCalled();
        $codeDetector->hasOneUseBelow($text)->willReturn(false);
        $editor->insertBelow($text, CodeEditor::EMPTY_LINE)->shouldBeCalled();

        $this->addUse($text, self::FULLY_QUALIFIED_CLASSNAME);
    }

    function it_inserts_first_property(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $codeNavigator->goToClassOpening($text)->shouldBeCalled();
        $codeDetector->hasOneUseBelow($text)->willReturn(false);
        $editor->insertBelow($text, self::PROPERTY)->shouldBeCalled();
        $editor->insertBelow($text, CodeEditor::EMPTY_LINE)->shouldBeCalled();

        $this->addProperty($text, self::VARIABLE_NAME);
    }

    function it_inserts_first_method_argument(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $lines = array(self::EMPTY_CONSTRUCTOR);

        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $codeDetector->hasAnyArguments($text, self::METHOD_NAME)->willReturn(false);
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $text->getLines()->willReturn($lines);
        $editor->replace($text, self::CONSTRUCTOR_ONE_ARGUMENT)->shouldBeCalled();

        $this->addArgument($text, self::METHOD_NAME, self::ARGUMENT_NAME, self::ARGUMENT_TYPE);
    }

    function it_inserts_another_property_to_inline_method(
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Editor $editor,
        Text $text
    )
    {
        $lines = array(self::INLINE_CONSTRUCTOR);

        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $codeDetector->hasAnyArguments($text, self::METHOD_NAME)->willReturn(true);
        $text->getCurrentLineNumber()->willReturn(self::LINE_NUMBER);
        $text->getLines()->willReturn($lines);
        $editor->replace($text, self::INLINE_CONSTRUCTOR_ARGUMENTS)->shouldBeCalled();

        $this->addArgument($text, self::METHOD_NAME, self::ARGUMENT_NAME, self::ARGUMENT_TYPE);
    }
}
