<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Collection;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Argument;

class ArgumentCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroArguments()
    {
        $arguments = array();

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('', $generatedCode);
    }

    public function testOneArgument()
    {
        $arguments = array(
            new Argument('bool', 'isObject'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('$isObject', $generatedCode);
    }

    public function testThreeArguments()
    {
        $arguments = array(
            new Argument('\\SplFileInfo', 'file'),
            new Argument('string', 'newLine'),
            new Argument('int', 'lineNumber'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('\\SplFileInfo $file, $newLine, $lineNumber', $generatedCode);
    }

    public function testTooManyArgumentsToBeOnOneLine()
    {
        $arguments = array();
        for ($i = 1; $i < 12; $i++) {
            $arguments[] = new Argument('mixed', 'argument'.$i);
        }

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertExpectedCode($generatedCode);
    }

    public function testRestrictInlineLength()
    {
        $arguments = array();
        for ($i = 1; $i < 9; $i++) {
            $arguments[] = new Argument('mixed', 'argument'.$i);
        }
        $generatedCode = $this->prettyPrinter->generateCode($arguments, array(
            'length_restriction' => strlen('    public function __construct()'),
        ));

        $this->assertExpectedCode($generatedCode);
    }
}
