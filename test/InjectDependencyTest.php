<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    public function testEmptyServiceWithConstants()
    {
        $input = new Input();
        $input->fixtureName = 'EmptyServiceWithConstants';
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

    public function testNotEmptyService()
    {
        $input = new Input();
        $input->fixtureName = 'NotEmptyService';
        $input->commandName = 'd:i';
        $input->fullyQualifiedClassname = 'fixture\Gnugat\Medio\SubDir\Dependency';

        $this->runFor($input);
    }

    public function testNotEmptyServiceWithConstants()
    {
        $input = new Input();
        $input->fixtureName = 'NotEmptyServiceWithConstants';
        $input->commandName = 'd:i';
        $input->fullyQualifiedClassname = 'fixture\Gnugat\Medio\SubDir\Dependency';

        $this->runFor($input);
    }
}
