<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodPhpdoc;
use Gnugat\Medio\Model\Type;

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
