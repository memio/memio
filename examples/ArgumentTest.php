<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples;

use Memio\Model\Argument;

class ArgumentTest extends PrettyPrinterTestCase
{
    public function testNonTypeHinted()
    {
        $argument = new Argument('string', 'filename');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('$filename', $generatedCode);
    }

    public function testArray()
    {
        $argument = new Argument('array', 'parameters');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('array $parameters', $generatedCode);
    }

    public function testCallable()
    {
        $argument = new Argument('callable', 'factory');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $expectedCode = (version_compare(PHP_VERSION, '5.4.0') >= 0 ? 'callable $factory' : '$factory');
        $this->assertSame($expectedCode, $generatedCode);
    }

    public function testObject()
    {
        $argument = new Argument('DateTime', 'dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('DateTime $dateTime', $generatedCode);
    }

    public function testDefaultNullValueForObject()
    {
        $argument = Argument::make('DateTime', 'dateTime')
            ->setDefaultValue('null')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('DateTime $dateTime = null', $generatedCode);
    }

    public function testDefaultStringValueForObject()
    {
        $argument = Argument::make('string', 'status')
            ->setDefaultValue('"A"')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('$status = "A"', $generatedCode);
    }

    public function testDefaultConstantValueForObject()
    {
        $argument = Argument::make('string', 'status')
            ->setDefaultValue('self::DEFAULT_STATUS')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('$status = self::DEFAULT_STATUS', $generatedCode);
    }
}
