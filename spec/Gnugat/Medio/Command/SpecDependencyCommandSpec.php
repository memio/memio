<?php

namespace spec\Gnugat\Medio\Command;

use Gnugat\Medio\Command\Command;
use Gnugat\Medio\Convertor;
use Gnugat\Medio\Editor;
use Gnugat\Medio\File;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpecDependencyCommandSpec extends ObjectBehavior
{
    const FULLY_QUALIFIED_CLASSNAME = 'fixture\Gnugat\Medio\Dependency';
    const CLASS_NAME = 'Dependency';
    const VARIABLE_NAME = 'dependency';

    const FILENAME = 'fixture/Gnugat/Medio/Class.php';

    function let(Convertor $convertor, Editor $editor)
    {
        $this->beConstructedWith($convertor, $editor);
    }

    function it_is_a_command()
    {
        $this->shouldImplement('Gnugat\Medio\Command\Command');
    }

    function it_specifies_a_dependency(Convertor $convertor, Editor $editor, File $file)
    {
        $convertor->toClassName(self::FULLY_QUALIFIED_CLASSNAME)->willReturn(self::CLASS_NAME);
        $convertor->toVariableName(self::CLASS_NAME)->willReturn(self::VARIABLE_NAME);

        $editor->open(self::FILENAME)->willReturn($file);
        $editor->addUse($file, self::FULLY_QUALIFIED_CLASSNAME)->shouldBeCalled();
        $editor->addDependencyMock($file, self::CLASS_NAME, self::VARIABLE_NAME)->shouldBeCalled();
        $editor->save($file)->shouldBeCalled();

        $this->run(self::FULLY_QUALIFIED_CLASSNAME, self::FILENAME)->shouldBe(Command::EXIT_SUCCESS);
    }
}
