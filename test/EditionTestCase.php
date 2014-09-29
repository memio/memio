<?php

namespace test\Gnugat\Medio;

class EditionTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepares a new copy of fixture and returns its filename.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getFixture($name)
    {
        $before = __DIR__.'/before/'.$name.'.php';
        $after = __DIR__.'/after/'.$name.'.php';
        if (file_exists($after)) {
            unlink($after);
        }
        copy($before, $after);

        return $after;
    }

    /**
     * @param string $name
     */
    protected function assertCorrectlyEdited($name)
    {
        $afterFilename = __DIR__.'/after/'.$name.'.php';
        $expectedFilename = __DIR__.'/expected/'.$name.'.php';

        $after = file_get_contents($afterFilename);
        $expected = file_get_contents($expectedFilename);

        $this->assertSame($expected, $after, 'Failed to correctly edit '.$name);
    }
}
