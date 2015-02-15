<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples;

use DI\ContainerBuilder;
use Inject;
use PHPUnit_Framework_TestCase;

class PrettyPrinterTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Gnugat\Medio\PrettyPrinter
     * @Inject
     */
    protected $prettyPrinter;

    protected function setUp()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(__DIR__.'/../config/phpdi.php');
        $container = $containerBuilder->build();
        $container->injectOn($this);
    }

    protected function assertExpectedCode($generatedCode)
    {
        $trace = debug_backtrace();
        $testFullyQualifiedClassname = $trace[1]['class'];
        $namespaces = explode('\\', $testFullyQualifiedClassname);
        $testClass = end($namespaces);
        $testMethod = $trace[1]['function'];
        $filename = __DIR__.'/fixtures/'.$testClass.'/'.$testMethod.'.txt';
        $expectedCode = substr(file_get_contents($filename), 0, -1);

        $this->assertSame($expectedCode, $generatedCode);
    }
}
