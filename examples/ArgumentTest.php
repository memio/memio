<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Type;

class ArgumentTest extends PrettyPrinterTestCase
{
    public function testNonTypeHinted()
    {
        $argument = new Argument(new Type('string'), 'filename');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('$filename', $generatedCode);
    }

    public function testArray()
    {
        $argument = new Argument(new Type('array'), 'parameters');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('array $parameters', $generatedCode);
    }

    public function testCallable()
    {
        $argument = new Argument(new Type('callable'), 'factory');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $expectedCode = (version_compare(PHP_VERSION, '5.4.0') >= 0 ? 'callable $factory' : '$factory');
        $this->assertSame($expectedCode, $generatedCode);
    }

    public function testObject()
    {
        $argument = new Argument(new Type('\\DateTime'), 'dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('\\DateTime $dateTime', $generatedCode);
    }
}
