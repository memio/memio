<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Model\Method;
use Gnugat\Medio\Model\Type;

class MethodTest extends PrettyPrinterTestCase
{
    public function testWithoutArguments()
    {
        $method = new Method('isEnabled');

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithInlineArguments()
    {
        $method = new Method('it_has_too_many_argument_yes');
        for ($i = 1; $i < 7; $i++) {
            $method->addArgument(new Argument(new Type('string'), 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }

    public function testWithMultilineArguments()
    {
        $method = new Method('it_has_too_many_argument_yeah');
        for ($i = 1; $i < 7; $i++) {
            $method->addArgument(new Argument(new Type('string'), 'argument'.$i));
        }

        $generatedCode = $this->prettyPrinter->generateCode($method);

        $this->assertExpectedCode($generatedCode);
    }
}
