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
use Memio\Model\Phpdoc\PropertyPhpdoc;
use Memio\Model\Phpdoc\VariableTag;

class PropertyCollectionTest extends PrettyPrinterTestCase
{
    public function testZeroProperties()
    {
        $properties = [];

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertSame('', $generatedCode);
    }

    public function testOneProperty()
    {
        $properties = [
            new Property('dateTime'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertExpectedCode($generatedCode);
    }

    public function testThreeProperties()
    {
        $properties = [
            new Property('dateTime'),
            new Property('arrayObject'),
            new Property('isEnabled'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertExpectedCode($generatedCode);
    }

    public function testPhpdocProperties()
    {
        $properties = [
            (new Property('myString'))
                ->setPhpdoc((new PropertyPhpdoc())
                    ->setVariableTag(new VariableTag('string'))
                )
            ,
            new Property('dateTime'),
            (new Property('arrayObject'))
                ->setPhpdoc((new PropertyPhpdoc())
                    ->setVariableTag(new VariableTag('array'))
                )
            ,
            new Property('isEnabled'),
        ];

        $generatedCode = $this->prettyPrinter->generateCode($properties);

        $this->assertExpectedCode($generatedCode);
    }
}
