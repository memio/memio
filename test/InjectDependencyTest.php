<?php

namespace test\Gnugat\Medio;

use Gnugat\Medio\Application;

class InjectDependencyTest extends EditionTestCase
{
    public function testEmptyService()
    {
        $filename = $this->getFixture('EmptyService');

        $argv = array(
            'medio',
            'd:i',
            'fixture\Gnugat\Medio\SubDir\Dependency',
            $filename,
        );

        $application = new Application();
        $application->run(count($argv), $argv);

        $this->assertCorrectlyEdited('EmptyService');
    }
}
