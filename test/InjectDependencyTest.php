<?php

namespace test\Gnugat\Medio;

use test\Gnugat\Medio\Helper\Input;

class InjectDependencyTest extends EditionTestCase
{
    public function testEmptyService()
    {
        $input = new Input();
        $input->fixtureName = 'EmptyService';
        $input->commandName = 'd:i';
        $input->fullyQualifiedClassname = 'fixture\Gnugat\Medio\SubDir\Dependency';

        $this->runFor($input);
    }

    public function testSameNamespace()
    {
        $input = new Input();
        $input->fixtureName = 'SameNamespaceService';
        $input->commandName = 'd:i';
        $input->fullyQualifiedClassname = 'fixture\Gnugat\Medio\Dependency';

        $this->runFor($input);
    }
}
