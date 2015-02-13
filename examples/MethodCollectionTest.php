<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\MethodCollection;
use Gnugat\Medio\Model\Type;

class MethodCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroMethods()
    {
        $methodCollection = new MethodCollection();

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneMethod()
    {
        $methodCollection = MethodCollection::make()
            ->add(new Method('__construct'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeMethods()
    {
        $methodCollection = MethodCollection::make()
            ->add(Method::make('__construct')
                ->addArgument(new Argument(new Type('DateTime'), 'dateTime'))
                ->addArgument(new Argument(new Type('ArrayObject'), 'arrayObject'))
            )
            ->add(new Method('getDateTime'))
            ->add(new Method('getArrayObject'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($methodCollection);

        $this->assertExpectedCode($generatedCode);
    }
}
