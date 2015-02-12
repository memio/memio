<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodCollection;
use Gnugat\Medio\Model\Type;

class GeneratingMethodCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroMethods()
    {
        $methodCollection = new MethodCollection();

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneMethod()
    {
        $methodCollection = new MethodCollection();
        $methodCollection->add(new Method('__construct'));

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }

    public function testThreeMethods()
    {
        $methodCollection = new MethodCollection();
        $methodCollection->add(Method::make('__construct')
            ->addArgument(new Argument(new Type('DateTime'), 'dateTime'))
            ->addArgument(new Argument(new Type('ArrayObject'), 'arrayObject'))
        );
        $methodCollection->add(new Method('getDateTime'));
        $methodCollection->add(new Method('getArrayObject'));

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertSame(get_expected_code(), $generatedCode);
    }
}
