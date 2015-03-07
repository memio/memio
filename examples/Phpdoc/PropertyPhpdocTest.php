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
use Gnugat\Medio\Model\Phpdoc\PropertyPhpdoc;
use Gnugat\Medio\Model\Phpdoc\PropertyTag;

class PropertyPhpdocTest extends PrettyPrinterTestCase
{
    public function testEmpty()
    {
        $propertyPhpdoc = new PropertyPhpdoc();

        $generatedCode = $this->prettyPrinter->generateCode($propertyPhpdoc);

        $this->assertSame('', $generatedCode);
    }

    public function testOneTag()
    {
        $propertyPhpdoc = PropertyPhpdoc::make()
            ->setPropertyTag(new PropertyTag('Gnugat\Medio\MyClass'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }
}
