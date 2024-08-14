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
        $arguments = [];

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('', $generatedCode);
    }

    public function testOneArgument()
    {
        $arguments = [
            new Argument('bool', 'isObject'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('bool $isObject', $generatedCode);
    }

    public function testThreeArguments()
    {
        $arguments = [
            new Argument('SplFileInfo', 'file'),
            new Argument('string', 'newLine'),
            new Argument('int', 'lineNumber'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertSame('SplFileInfo $file, string $newLine, int $lineNumber', $generatedCode);
    }

    public function testTooManyArgumentsToBeOnOneLine()
    {
        $arguments = [];
        for ($i = 1; $i < 12; $i++) {
            $arguments[] = new Argument('mixed', 'argument'.$i);
        }

        $generatedCode = $this->prettyPrinter->generateCode($arguments);

        $this->assertExpectedCode($generatedCode);
    }

    public function testRestrictInlineLength()
    {
        $arguments = [];
        for ($i = 1; $i < 9; $i++) {
            $arguments[] = new Argument('mixed', 'argument'.$i);
        }
        $generatedCode = $this->prettyPrinter->generateCode($arguments, [
            'length_restriction' => strlen('    public function __construct()'),
        ]);

        $this->assertExpectedCode($generatedCode);
    }
}
