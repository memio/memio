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
use Gnugat\Medio\ValueObject\Collection;

class PropertyCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroProperties()
    {
        $propertyCollection = new Collection('Gnugat\\Medio\\Model\\Property');

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertSame('', $generatedCode);
    }

    public function testOneProperty()
    {
        $propertyCollection = Collection::make('Gnugat\\Medio\\Model\\Property')
            ->add(new Property('dateTime'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeProperties()
    {
        $propertyCollection = Collection::make('Gnugat\\Medio\\Model\\Property')
            ->add(new Property('dateTime'))
            ->add(new Property('arrayObject'))
            ->add(new Property('isEnabled'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyCollection);

        $this->assertExpectedCode($generatedCode);
    }
}
