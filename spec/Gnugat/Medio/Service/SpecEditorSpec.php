<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\SpecEditor;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;

class SpecEditorSpec extends ObjectBehavior
{
    const METHOD_NAME = 'let';
    const METHOD = '    function let()';

    function let(Editor $editor)
    {
        $this->beConstructedWith($editor);
    }

    function it_inserts_a_method(Editor $editor, Text $text)
    {
        $editor->jumpBelow($text, SpecEditor::CLASS_ENDING, 0)->shouldBeCalled();
        $editor->insertAbove($text, SpecEditor::METHOD_ENDING)->shouldBeCalled();
        $editor->insertAbove($text, SpecEditor::METHOD_OPENING)->shouldBeCalled();
        $editor->insertAbove($text, self::METHOD)->shouldBeCalled();

        $this->addMethod($text, self::METHOD_NAME);
    }
}
