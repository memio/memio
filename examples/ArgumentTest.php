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
        $argument = new Argument('\\DateTime', 'dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($argument);

        $this->assertSame('\\DateTime $dateTime', $generatedCode);
    }
}
