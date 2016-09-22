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
use Memio\Model\FullyQualifiedName;

class FullyQualifiedNameCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroFullyQualifiedNames()
    {
        $fullyQualifiedNames = [];

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertSame('', $generatedCode);
    }

    public function testOneFullyQualifiedName()
    {
        $fullyQualifiedNames = [
            new FullyQualifiedName('DateTime'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeFullyQualifiedNames()
    {
        $fullyQualifiedNames = [
            new FullyQualifiedName('DateTime'),
            new FullyQualifiedName('ArrayObject'),
            new FullyQualifiedName('stdClass'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertExpectedCode($generatedCode);
    }
}
