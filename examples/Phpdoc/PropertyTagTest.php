<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Examples\Phpdoc;

use Gnugat\Medio\Examples\PrettyPrinterTestCase;
use Gnugat\Medio\Model\Phpdoc\PropertyTag;

class PropertyTagTest extends PrettyPrinterTestCase
{
    public function testType()
    {
        $propertyTag = new PropertyTag('string');

        $generatedCode = $this->prettyPrinter->generateCode($propertyTag);

        $this->assertSame('@var string', $generatedCode);
    }
}
