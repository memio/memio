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

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodPhpdoc;
use Gnugat\Medio\ValueObject\Type;

class MethodPhpdocTest extends PrettyPrinterTestCase
{
    public function testZeroParameters()
    {
        $methodPhpdoc = new MethodPhpdoc(new Method('__construct'));

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertSame('', $generatedCode);
    }

    public function testOneParameter()
    {
        $methodPhpdoc = new MethodPhpdoc(Method::make('__construct')
            ->addArgument(new Argument(new Type('bool'), 'isObject'))
        );

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeParameters()
    {
        $methodPhpdoc = new MethodPhpdoc(Method::make('__construct')
            ->addArgument(new Argument(new Type('\\SplFileInfo'), 'file'))
            ->addArgument(new Argument(new Type('string'), 'newLine'))
            ->addArgument(new Argument(new Type('int'), 'lineNumber'))
        );

        $generatedCode = $this->prettyPrinter->generateCode($methodPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }
}
