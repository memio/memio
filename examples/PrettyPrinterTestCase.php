<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples;

use Memio\Memio\Config\Build;
use PHPUnit\Framework\TestCase;

class PrettyPrinterTestCase extends TestCase
{
    protected $prettyPrinter;

    protected function setUp()
    {
        $this->prettyPrinter = Build::prettyPrinter();
    }

    protected function assertExpectedCode($generatedCode)
    {
        $trace = debug_backtrace();
        $testFqcn = $trace[1]['class'];
        $type = substr($testFqcn, strlen('Memio\Memio\Examples\\'));
        $path = str_replace('\\', '/', $type);
        $testMethod = $trace[1]['function'];
        $filename = __DIR__.'/fixtures/'.$path.'/'.$testMethod.'.txt';
        $expectedCode = substr(file_get_contents($filename), 0, -1);

        $this->assertSame($expectedCode, $generatedCode);
    }
}
