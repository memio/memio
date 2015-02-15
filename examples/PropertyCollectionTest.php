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

use Gnugat\Medio\Model\Property;
use Gnugat\Medio\Model\PropertyCollection;

class PropertyCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroProperties()
    {
        $propertyCollection = new PropertyCollection();

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneProperty()
    {
        $propertyCollection = PropertyCollection::make()
            ->add(new Property('dateTime'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeProperties()
    {
        $propertyCollection = PropertyCollection::make()
            ->add(new Property('dateTime'))
            ->add(new Property('arrayObject'))
            ->add(new Property('isEnabled'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertExpectedCode($generatedCode);
    }
}
