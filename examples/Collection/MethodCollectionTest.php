<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Collection;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Argument;
use Memio\Model\Method;

class MethodCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroMethods()
    {
        $methods = [];

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertSame('', $generatedCode);
    }

    public function testOneMethod()
    {
        $methods = [
            new Method('__construct'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeMethods()
    {
        $methods = [
            (new Method('__construct'))
                ->addArgument(new Argument('DateTime', 'dateTime'))
                ->addArgument(new Argument('ArrayObject', 'arrayObject'))
            ,
            new Method('getDateTime'),
            new Method('getArrayObject'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($methods);

        $this->assertExpectedCode($generatedCode);
    }
}
