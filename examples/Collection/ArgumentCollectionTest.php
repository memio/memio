<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Collection;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Argument;

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
            new Argument('SplFileInfo', 'file'),
            new Argument('string', 'newLine'),
            new Argument('int', 'lineNumber'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('SplFileInfo $file, $newLine, $lineNumber', $generatedCode);
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
