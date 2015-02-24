<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;

class MethodCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroMethods()
    {
        $methods = array();

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertSame('', $generatedCode);
    }

    public function testOneMethod()
    {
        $methods = array(
            new Method('__construct'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeMethods()
    {
        $methods = array(
            Method::make('__construct')
                ->addArgument(new Argument('DateTime', 'dateTime'))
                ->addArgument(new Argument('ArrayObject', 'arrayObject'))
            ,
            new Method('getDateTime'),
            new Method('getArrayObject'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertExpectedCode($generatedCode);
    }
}
