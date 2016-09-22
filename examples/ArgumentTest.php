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
        $argument = new Argument('mixed', 'filename');

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

        $this->assertSame('callable $factory', $generatedCode);
    }

    public function testObject()
    {
        $argument = new Argument('DateTime', 'dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('DateTime $dateTime', $generatedCode);
    }

    public function testDefaultNullValueForObject()
    {
        $argument = (new Argument('DateTime', 'dateTime'))
            ->setDefaultValue('null')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('DateTime $dateTime = null', $generatedCode);
    }

    public function testDefaultStringValueForObject()
    {
        $argument = (new Argument('string', 'status'))
            ->setDefaultValue('"A"')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('string $status = "A"', $generatedCode);
    }

    public function testDefaultConstantValueForObject()
    {
        $argument = (new Argument('string', 'status'))
            ->setDefaultValue('self::DEFAULT_STATUS')
        ;

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('string $status = self::DEFAULT_STATUS', $generatedCode);
    }
}
