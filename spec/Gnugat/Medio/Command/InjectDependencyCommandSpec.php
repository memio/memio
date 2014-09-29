<?php

namespace spec\Gnugat\Medio\Command;

use Gnugat\Medio\Command\Command;
use Gnugat\Medio\Convertor;
use Gnugat\Medio\PhpEditor;
use Gnugat\Redaktilo\File;
use PhpSpec\ObjectBehavior;

class InjectDependencyCommandSpec extends ObjectBehavior
{
    const FULLY_QUALIFIED_CLASSNAME = 'fixture\Gnugat\Medio\Dependency';
    const CLASS_NAME = 'Dependency';
    const VARIABLE_NAME = 'dependency';

    const FILENAME = 'fixture/Gnugat/Medio/Class.php';

    function let(Convertor $convertor, PhpEditor $phpEditor)
    {
        $this->beConstructedWith($convertor, $phpEditor);
    }

    function it_is_a_command()
    {
        $this->shouldImplement('Gnugat\Medio\Command\Command');
    }

    function it_injects_a_dependency_in_a_class(Convertor $convertor, PhpEditor $phpEditor, File $file)
    {
        $convertor->toClassName(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::CLASS_NAME);
        $convertor->toVariableName(self::CLASS_NAME)->willReturn(self::VARIABLE_NAME);

        $phpEditor->open(self::FILENAME)->willReturn($file);
        $phpEditor->addUse($file, self::FULLY_QUALIFIED_CLASSNAME)->shouldBeCalled();
        $phpEditor->addProperty($file, self::CLASS_NAME, self::VARIABLE_NAME)->shouldBeCalled();
        $phpEditor->addDependency($file, self::CLASS_NAME, self::VARIABLE_NAME)->shouldBeCalled();
        $phpEditor->save($file)->shouldBeCalled();

        $this->run(self::FULLY_QUALIFIED_CLASSNAME, self::FILENAME)->shouldBe(Command::EXIT_SUCCESS);
    }
}
