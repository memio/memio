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
}
