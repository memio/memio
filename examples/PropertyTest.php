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
        $property = (new Property('myClass'))
            ->setPhpdoc((new PropertyPhpdoc())
                ->setVariableTag(new VariableTag('Memio\Memio\MyClass'))
            )
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertExpectedCode($generatedCode);
    }

    public function testPublicVisibility()
    {
        $property = (new Property('dto'))
            ->makePublic()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    public $dto;', $generatedCode);
    }

    public function testProtectedVisibility()
    {
        $property = (new Property('inheritanceIsBad'))
            ->makeProtected()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    protected $inheritanceIsBad;', $generatedCode);
    }

    public function testStatic()
    {
        $property = (new Property('property'))
            ->makeStatic()
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private static $property;', $generatedCode);
    }

    public function testDefaultValue()
    {
        $property = (new Property('property'))
            ->setDefaultValue("'default'")
        ;

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private $property = \'default\';', $generatedCode);
    }
}
