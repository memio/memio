<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Gnugat\Medio\Command;

use Gnugat\Medio\Command\Command;
use Gnugat\Medio\Convertor;
use Gnugat\Medio\Service\CodeDetector;
use Gnugat\Medio\Service\CodeEditor;
use Gnugat\Redaktilo\Editor;
use Gnugat\Redaktilo\File;
use PhpSpec\ObjectBehavior;

class InjectDependencyCommandSpec extends ObjectBehavior
{
    const FULLY_QUALIFIED_CLASSNAME = 'fixture\Gnugat\Medio\Dependency';
    const NAME_SPACE = 'fixture\Gnugat\Medio';
    const CLASS_NAME = 'Dependency';
    const VARIABLE_NAME = 'dependency';

    const FILENAME = 'fixture/Gnugat/Medio/Class.php';

    function let(
        CodeDetector $codeDetector,
        CodeEditor $codeEditor,
        Convertor $convertor,
        Editor $editor
    )
    {
        $this->beConstructedWith($codeDetector, $codeEditor, $convertor, $editor);
    }

    function it_is_a_command()
    {
        $this->shouldImplement('Gnugat\Medio\Command\Command');
    }

    function it_injects_first_dependency_in_a_class(
        CodeDetector $codeDetector,
        Convertor $convertor,
        CodeEditor $codeEditor,
        Editor $editor,
        File $file
    )
    {
        $convertor->toNamespace(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::NAME_SPACE);
        $convertor->toClassName(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::CLASS_NAME);
        $convertor->toVariableName(self::CLASS_NAME)->willReturn(self::VARIABLE_NAME);

        $editor->open(self::FILENAME)->willReturn($file);
        $codeDetector->isUseNeeded($file, self::NAME_SPACE)->willReturn(true);
        $codeEditor->addUse($file, self::FULLY_QUALIFIED_CLASSNAME)->shouldBeCalled();
        $codeEditor->addProperty($file, self::VARIABLE_NAME)->shouldBeCalled();
        $codeEditor->addArgument($file, '__construct', self::VARIABLE_NAME, self::CLASS_NAME)->shouldBeCalled();
        $codeEditor->addPropertyInitialization($file, '__construct', self::VARIABLE_NAME)->shouldBeCalled();
        $editor->save($file)->shouldBeCalled();

        $this->run(self::FULLY_QUALIFIED_CLASSNAME, self::FILENAME)->shouldBe(Command::EXIT_SUCCESS);
    }

    function it_injects_a_dependency_in_a_class_with_same_namespace(
        CodeDetector $codeDetector,
        Convertor $convertor,
        CodeEditor $codeEditor,
        Editor $editor,
        File $file
    )
    {
        $convertor->toNamespace(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::NAME_SPACE);
        $convertor->toClassName(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::CLASS_NAME);
        $convertor->toVariableName(self::CLASS_NAME)->willReturn(self::VARIABLE_NAME);

        $editor->open(self::FILENAME)->willReturn($file);
        $codeDetector->isUseNeeded($file, self::NAME_SPACE)->willReturn(false);
        $codeEditor->addProperty($file, self::VARIABLE_NAME)->shouldBeCalled();
        $codeEditor->addArgument($file, '__construct', self::VARIABLE_NAME, self::CLASS_NAME)->shouldBeCalled();
        $codeEditor->addPropertyInitialization($file, '__construct', self::VARIABLE_NAME)->shouldBeCalled();
        $editor->save($file)->shouldBeCalled();

        $this->run(self::FULLY_QUALIFIED_CLASSNAME, self::FILENAME)->shouldBe(Command::EXIT_SUCCESS);
    }
}
