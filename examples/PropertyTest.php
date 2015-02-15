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
}
