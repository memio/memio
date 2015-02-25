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
use Gnugat\Medio\Model\FullyQualifiedName;

class FullyQualifiedNameCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroFullyQualifiedNames()
    {
        $fullyQualifiedNames = array();

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertSame('', $generatedCode);
    }

    public function testOneFullyQualifiedName()
    {
        $fullyQualifiedNames = array(
            new FullyQualifiedName('DateTime'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeFullyQualifiedNames()
    {
        $fullyQualifiedNames = array(
            new FullyQualifiedName('DateTime'),
            new FullyQualifiedName('ArrayObject'),
            new FullyQualifiedName('stdClass'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($fullyQualifiedNames);

        $this->assertExpectedCode($generatedCode);
    }
}
