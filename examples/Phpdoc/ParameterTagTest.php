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
use Memio\Model\Phpdoc\ParameterTag;

class ParameterTagTest extends PrettyPrinterTestCase
{
    public function testSimple()
    {
        $parameterTag = new ParameterTag('Memio\Memio\MyClass', 'myClass');

        $generatedCode = $this->prettyPrinter->generateCode($parameterTag);

        $this->assertSame('@param MyClass $myClass', $generatedCode);
    }

    public function testWithDescription()
    {
        $parameterTag = new ParameterTag('Memio\Memio\MyClass', 'myClass', 'description');

        $generatedCode = $this->prettyPrinter->generateCode($parameterTag);

        $this->assertSame('@param MyClass $myClass description', $generatedCode);
    }
}
