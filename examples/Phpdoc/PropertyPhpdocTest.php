<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Examples\Phpdoc;

use Memio\Memio\Examples\PrettyPrinterTestCase;
use Memio\Model\Phpdoc\PropertyPhpdoc;
use Memio\Model\Phpdoc\VariableTag;

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
        $propertyPhpdoc = (new PropertyPhpdoc())
            ->setVariableTag(new VariableTag('Memio\Memio\MyClass'))
        ;

        $generatedCode = $this->prettyPrinter->generateCode($propertyPhpdoc);

        $this->assertExpectedCode($generatedCode);
    }
}
