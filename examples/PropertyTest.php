<?php

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
}
