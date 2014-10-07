<?php

namespace spec\Gnugat\Medio\Service;

use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeNavigator;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\Text;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MultilineEditorSpec extends ObjectBehavior
{
    const METHOD_NAME = '__construct';
    const ARGUMENT_NAME = 'dependency';
    const ARGUMENT_TYPE = 'Dependency';
    const NEW_ARGUMENT = '        Dependency $dependency';

    function let(CodeDetector $codeDetector, CodeNavigator $codeNavigator, Editor $editor)
    {
        $this->beConstructedWith($codeDetector, $codeNavigator, $editor);
    }

    function it_inserts_an_argument(
        Editor $editor,
        CodeDetector $codeDetector,
        CodeNavigator $codeNavigator,
        Text $text
    )
    {
        $codeNavigator->goToMethod($text, self::METHOD_NAME)->shouldBeCalled();
        $codeDetector->hasOneArgumentBelow($text)->willReturn(false);
        $closure = Argument::type('Closure');
        $editor->replace($text, $closure)->shouldBeCalled();
        $editor->insertBelow($text, self::NEW_ARGUMENT)->shouldBeCalled();

        $this->addArgument($text, self::METHOD_NAME, self::ARGUMENT_NAME, self::ARGUMENT_TYPE);
    }
}
