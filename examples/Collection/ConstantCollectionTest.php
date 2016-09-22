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
use Memio\Model\Constant;

class ConstantCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroConstants()
    {
        $constants = [];

        $generatedCode = $this->prettyPrinter->generateCode($constants);

        $this->assertSame('', $generatedCode);
    }

    public function testOneConstant()
    {
        $constants = [
            new Constant('MY_CONSTANT', '0'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($constants);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeConstants()
    {
        $constants = [
            new Constant('FIRST_CONSTANT', '0'),
            new Constant('SECOND_CONSTANT', '1'),
            new Constant('THIRD_CONSTANT', '2'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($constants);

        $this->assertExpectedCode($generatedCode);
    }
}
