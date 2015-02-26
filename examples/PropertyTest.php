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

class PropertyTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $property = new Property('dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private $dateTime;', $generatedCode);
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
