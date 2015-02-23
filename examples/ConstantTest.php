<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Constant;

class ConstantTest extends PrettyPrinterTestCase
{
    public function testIntegerValue()
    {
        $constant = new Constant('INTEGER_VALUE', '0');

        $generatedCode = $this->prettyPrinter->generateCode($constant);

        $this->assertSame('    const INTEGER_VALUE = 0;', $generatedCode);
    }

    public function testStringValue()
    {
        $constant = new Constant('STRING_VALUE', "'meh'");

        $generatedCode = $this->prettyPrinter->generateCode($constant);

        $this->assertSame("    const STRING_VALUE = 'meh';", $generatedCode);
    }

    public function testBooleanValue()
    {
        $constant = new Constant('BOOLEAN_VALUE', 'true');

        $generatedCode = $this->prettyPrinter->generateCode($constant);

        $this->assertSame('    const BOOLEAN_VALUE = true;', $generatedCode);
    }

    public function testArrayValue()
    {
        $constant = new Constant('ARRAY_VALUE', "['a', 'b']");

        $generatedCode = $this->prettyPrinter->generateCode($constant);

        $this->assertSame("    const ARRAY_VALUE = ['a', 'b'];", $generatedCode);
    }

    public function testExpressionValue()
    {
        $constant = new Constant('EXPRESSION_VALUE', "'Nobody expects the '.self::SPANISH_INQUISITION + 1");

        $generatedCode = $this->prettyPrinter->generateCode($constant);

        $this->assertSame("    const EXPRESSION_VALUE = 'Nobody expects the '.self::SPANISH_INQUISITION + 1;", $generatedCode);
    }
}
