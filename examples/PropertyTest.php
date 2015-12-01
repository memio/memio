<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples;

use Memio\Model\Phpdoc\PropertyPhpdoc;
use Memio\Model\Phpdoc\VariableTag;
use Memio\Model\Property;

class PropertyTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $property = new Property('dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private $dateTime;', $generatedCode);
    }

    public function testWithPhpdoc()
    {
        $property = Property::make('myClass')
            ->setPhpdoc(PropertyPhpdoc::make()
                ->setVariableTag(new VariableTag('Memio\Memio\MyClass'))
            )
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertExpectedCode($generatedCode);
    }

    public function testPublicVisibility()
    {
        $property = Property::make('dto')
            ->makePublic()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    public $dto;', $generatedCode);
    }

    public function testProtectedVisibility()
    {
        $property = Property::make('inheritanceIsBad')
            ->makeProtected()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    protected $inheritanceIsBad;', $generatedCode);
    }

    public function testStatic()
    {
        $property = Property::make('property')
            ->makeStatic()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private static $property;', $generatedCode);
    }

    public function testDefaultValue()
    {
        $property = Property::make('property')
            ->setDefaultValue("'default'")
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private $property = \'default\';', $generatedCode);
    }
}
