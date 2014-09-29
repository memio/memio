<?php

namespace test\Gnugat\Medio;

use Gnugat\Medio\Application;

class SpecDependencyTest extends EditionTestCase
{
    public function testEmptySpec()
    {
        $filename = $this->getFixture('EmptySpec');

        $argv = array(
            'medio',
            'd:s',
            'fixture\Gnugat\Medio\SubDir\Dependency',
            $filename,
        );

        $application = new Application();
        $application->run(count($argv), $argv);

        $this->assertCorrectlyEdited('EmptySpec');
    }
}
