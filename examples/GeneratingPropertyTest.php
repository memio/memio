<?php

namespace Gnugat\Medio\Examples;

use Gnugat\Medio\Model\Property;

class GeneratingPropertyTest extends PrettyPrinterTestCase
{
    public function testSimpleOne()
    {
        $property = new Property('dateTime');

        $generatedCode = $this->prettyPrinter->generateCode($property);

        $this->assertSame('    private $dateTime;', $generatedCode);
    }
}
