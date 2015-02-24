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
use Gnugat\Medio\Model\Property;

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
