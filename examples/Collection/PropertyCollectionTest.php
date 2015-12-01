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
use Memio\Model\Property;

class PropertyCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroProperties()
    {
        $properties = array();

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertSame('', $generatedCode);
    }

    public function testOneProperty()
    {
        $properties = array(
            new Property('dateTime'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeProperties()
    {
        $properties = array(
            new Property('dateTime'),
            new Property('arrayObject'),
            new Property('isEnabled'),
        );

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertExpectedCode($generatedCode);
    }
}
